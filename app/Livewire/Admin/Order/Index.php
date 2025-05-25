<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Services\DeliveryContext;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $paginate = 10;
    public $search = "";
    public $language;

    public function  mount()
    {
        $this->language = app()->getLocale();
    }
    #[Computed]

    public function orders()
    {
        return Order::orderByDesc('id')->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }
    #[On('delete')]
    public function delete($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            $this->dispatch('show-toast-alert', [
                "text" => __('Order deleted successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not delete this Order!'),
                'icon' => "warning"
            ]);
        }
    }

    public function refresh()
    {
        try {
            $delivery = new DeliveryContext("Zrexpress");
            $orders = Order::whereHas('latestStatus', function ($query) {
                $query->whereHas('status', function ($query) {
                    $query->whereIn('name', ['InDelivery', 'Alert']);;
                });
            })->get();
            $delivery->getOrders($orders);
            $this->dispatch('show-toast-alert', [
                "text" => __('Orders updated successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not update Orders!'),
                'icon' => "warning"
            ]);
        }
    }

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.order.index')->with([
            'orders' => $this->orders->paginate($this->paginate)
        ]);
    }
}
