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
    public ?int $selectedState = null;
    public ?int $selectedCity = null;
    public string $name = '';
    public string $phone = '';
    public int $quantity = 1;
    public bool $deliveryType = false;  // 0 or 1 but better bool
    public string $language;
    public float $largeurTotal = 0;
    public bool $successPage = false;
    public ?string $email = null;

    public array $dimensions = [
        [
            'room_number' => 1,
            'largeur' => '',
        ]
    ];

    public function mount()
    {
        $this->language = app()->getLocale();
    }

    #[Computed()]
    public function states()
    {
        return State::whereNotNull('zr_domicile')
            ->orWhereNotNull('zr_stopdesk')
            ->with("cities")
            ->get();
    }

    #[Computed()]
    public function selectedStateModel()
    {
        return $this->selectedState ? $this->states->firstWhere('id', $this->selectedState) : null;
    }

    #[Computed()]
    public function cities()
    {
        return $this->selectedState ? City::where('state_id', $this->selectedState)->get() : collect();
    }

    #[Computed()]
    public function productPrice()
    {
        if ($this->product->category->name_fr == 'La Rail')
            return $this->product->price * $this->largeurTotal;

        return $this->quantity * $this->product->price;
    }
    #[Computed()]
    public function deliveryPrice()
    {
        if ($this->deliveryType && $this->selectedStateModel) {
            return $this->selectedStateModel->zr_stopdesk;
        } elseif (!$this->deliveryType && $this->selectedCity) {
            $city = $this->cities->firstWhere('id', $this->selectedCity);
            return $city?->state?->zr_domicile;
        }
        return null;
    }

    #[Computed()]
    public function relatedProducts()
    {
        return Product::where('available', true)
            ->where('category_id', $this->product->category->id)
            ->where('id', '!=', $this->product->id)
            ->orderByDesc('id')
            ->get();
    }

    public function updatedQuantity($value)
    {
        $value = max(1, intval($value));
        $this->dimensions = array_fill(0, $value, ['room_number' => '', 'largeur' => '']);
        $this->recalculateLargeurTotal();
    }

    public function updatedDimensions()
    {
        $this->recalculateLargeurTotal();
    }

    public function recalculateLargeurTotal()
    {
        $this->largeurTotal = collect($this->dimensions)
            ->pluck('largeur')
            ->filter(fn($val) => is_numeric($val))
            ->map(function ($val) {
                return ceil($val * 2) / 2;
            })
            ->sum();
    }

    public function updatedSelectedState()
    {
        $this->selectedCity = null;
        $cities = $this->cities;
        if ($cities->count() === 1) {
            $this->selectedCity = $cities->first()->id;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:8,15',
            'selectedState' => 'required|exists:states,id',
            'email' => 'nullable|email',
            'selectedCity' => [
                Rule::requiredIf(fn() => !$this->deliveryType),
                'nullable',
                'exists:cities,id',
            ],
            'dimensions' => 'array',
            'dimensions.*.largeur' => [
                Rule::requiredIf(fn() => $this->product->category->name_fr == 'La Rail'),
                'numeric',
                'min:0.01',
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
                    'city_id' => $this->selectedCity ?? $this->selectedStateModel?->cities->first()?->id,
                ]);

                $order->products()->attach($this->product->id, [
                    'quantity' => $this->quantity,
                    'sell_price' => $this->product->price,
                ]);

                $pendingStatusId = Status::where('name', 'Pending')->value('id');
                $order->orderStatus()->create(['status_id' => $pendingStatusId]);

                if ($this->product->category->name_fr == 'La Rail') {
                    $dimensionModels = collect($this->dimensions)->map(function ($dim, $index) {
                        return new Dimension([
                            'room_number' => $dim['room_number'] ?: $index + 1,
                            'largeur' => $dim['largeur'],
                        ]);
                    })->all();
                    $order->dimension()->saveMany($dimensionModels);
                }

                $this->dispatch('show-toast-alert', [
                    'text' => __('Order Created successfully!'),
                    'icon' => 'success',
                ]);
                $this->successPage = true;
            });
        } catch (Throwable) {
            $this->dispatch('show-toast-alert', [
                'text' => __('Could not create this order!'),
                'icon' => 'warning',
            ]);
        }
    }

    #[Layout('components.layouts.client.app')]
    public function render()
    {
        return view('livewire.client.product.show');
    }
}
