<?php

namespace App\Livewire\Client\Product;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $paginate = 10;
    public $language;
    public $search = "";
    public function  mount()
    {
        $this->language = app()->getLocale();
    }
    #[Computed()]
    public function Products()
    {
        return Product::where('available', true)->orderByDesc('id')->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }
    #[Layout('components.layouts.client.app')]

    public function render()
    {
        return view('livewire.client.product.index')->with([
            'products' => $this->products->paginate($this->paginate)
        ]);;
    }
}
