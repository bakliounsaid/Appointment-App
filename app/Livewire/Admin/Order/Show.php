<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\Status;
use App\Services\DeliveryContext;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{

    public Order $order;
    public $language;
    protected $rules = [
        'order.delivery_service' => 'required|in:ZR,Default',
    ];
    public function  mount()
    {
        $this->language = app()->getLocale();
    }

    #[On('externService')]
    public function createOrderInDeliveryService()
    {
        try {
            if ($this->order->delivery_service == "ZR") {
                $delivery = new DeliveryContext("Zrexpress");
                $delivery->createOrder($this->order);
                $this->order->refresh();
                if ($this->order->tracking_code)
                    $this->dispatch('show-toast-alert', [
                        "text" => __('Order created in delivery service successfully!'),
                        'icon' => "success"
                    ]);
                else
                    $this->dispatch('show-toast-alert', [
                        "text" => __('Could not create this order in delivery service this Order!'),
                        'icon' => "warning"
                    ]);
            }
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not create this order in delivery service this Order!'),
                'icon' => "warning"
            ]);
        }
    }
    public function changeStatus($status)
    {
        try {
            $this->order->orderStatus()->create([
                'status_id' => Status::where('name', $status)->first()->id
            ]);
            $this->order->refresh();
            $this->dispatch('show-toast-alert', [
                "text" => __('Order status changed successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not change this order status!'),
                'icon' => "warning"
            ]);
        }
    }

    public function updatedOrderDeliveryService($value)
    {
        $this->validate();
        try {
            $this->order->save();
            $this->order->refresh();
            $this->dispatch('show-toast-alert', [
                "text" => __('Order delivery service changed successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not change this order delivery service!'),
                'icon' => "warning"
            ]);
        }
    }

    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.order.show');
    }
}
