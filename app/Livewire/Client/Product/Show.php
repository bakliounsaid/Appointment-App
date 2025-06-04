<?php

namespace App\Livewire\Client\Product;

use App\Models\City;
use App\Models\Dimension;
use App\Models\Order;
use App\Models\Product;
use App\Models\State;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

class Show extends Component
{
    public Product $product;
    public $selectedState;
    public $selectedCity;
    public $name;
    public $phone;
    public $quantity = 1;
    public $deliveryType;
    public $language;
    public $largeurTotal = 0;
    public $successPage = false;
    public $email;
    public $dimensions = [
        [
            'room_number' => 1,
            'largeur' => '',
        ]
    ];

    public function  mount()
    {
        $this->language = app()->getLocale();
    }

    #[Computed()]
    public function States()
    {
        return State::whereNotNull('zr_domicile')->orWhereNotNull('zr_stopdesk')->get();
    }

    public function updatedQuantity($value)
    {
        $this->dimensions = array_fill(0, $value, ['room_number' => '', 'largeur' => '']);
    }


    #[Computed()]
    public function cities()
    {
        if ($this->selectedState)
            return City::where('state_id', $this->selectedState)->get();
        else
            return [];
    }
    public function updatedDimensions($value)
    {
        intval($value);
        $this->largeurTotal += $value;
    }
    #[Computed()]
    public function productPrice()
    {
        if ($this->product->category->name_fr == 'La Rail')
            return   $this->product->price * $this->largeurTotal;
        else
            return  $this->quantity * $this->product->price;
    }

    #[Computed()]
    public function deliveryPrice()
    {
        if ($this->deliveryType && $this->selectedState) {
            return State::find($this->selectedState)->zr_stopdesk;
        } elseif (!$this->deliveryType && $this->selectedCity) {
            return City::find($this->selectedCity)->state->zr_domicile;
        } else return null;
    }
    #[Computed()]
    public function relatedProducts()
    {
        return Product::where('available', true)->orderByDesc('id')->where("category_id", $this->product->category->id)->get();
    }
    public function updatedSelectedState()
    {
        $this->selectedCity = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone'        => 'required|numeric|digits_between:8,15',
            'selectedState' => 'required|exists:states,id',
            'email' => 'nullable|email',
            'selectedCity' => [
                Rule::requiredIf(!$this->deliveryType),
                'nullable',
                'exists:cities,id'
            ],
            'dimensions.*.largeur' => [
                Rule::requiredIf($this->product->category->name_fr == 'La Rail'),
                'nullable',
                'numeric',
                'min:0.1'
            ],
            'quantity' => 'required|integer|min:1',
            'deliveryType' => 'boolean',
        ]);
        try {
            DB::transaction(function () {
                $order = Order::create([
                    'fullname' => $this->name,
                    'client_phone' => $this->phone,
                    'delivery_method' => $this->deliveryType,
                    'client_email' => $this->email ?? null,
                    'delivery_fees' => $this->deliveryPrice,
                    'city_id' => $this->selectedCity ?? State::find($this->selectedState)->cities->first()->id,
                ]);

                $order->products()->attach($this->product->id, [
                    'quantity' => $this->quantity,
                    'sell_price' => $this->product->price,
                ]);
                $order->orderStatus()->create([
                    'status_id' => Status::where('name', 'Pending')->first()->id
                ]);
                if ($this->product->category->name_fr == 'La Rail') {
                    $dimensionModels = collect($this->dimensions)->map(function ($dim, $index) {
                        if (empty($dim['room_number'])) {
                            $dim['room_number'] = $index + 1;
                        }
                        return new Dimension($dim);
                    })->all();
                    $order->dimension()->saveMany($dimensionModels);
                }

                $this->dispatch('show-toast-alert', [
                    "text" => __('Order Created successfully!'),
                    'icon' => "success"
                ]);
                $this->successPage = true;
            });
        } catch (Throwable $th) {
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not create this order!'),
                'icon' => "warning"
            ]);
        }
    }

    #[Layout('components.layouts.client.app')]

    public function render()
    {
        return view('livewire.client.product.show');
    }
}
