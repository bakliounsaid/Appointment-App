<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
    public function Products()
    {
        return Product::orderByDesc('id')->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }
    #[On('delete')]
    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);

            foreach ($product->media as $media) {
                 if (Storage::disk('public')->exists($media->url)) {
                     Storage::disk('public')->delete($media->url);
                }
            }

            $product->media()->delete();

            $product->delete();

            $this->dispatch('show-toast-alert', [
                "text" => __('Product deleted successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not delete this Product!'),
                'icon' => "warning"
            ]);
        }
    }
    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.product.index')->with([
            'products' => $this->products->paginate($this->paginate)
        ]);
    }
}
