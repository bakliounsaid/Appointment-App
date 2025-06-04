<?php

namespace App\Livewire\Client\Product;

use App\Models\Category;
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
    public $selectedCategory = null;
    public function  mount()
    {
        $this->language = app()->getLocale();
    }
    #[Computed()]
    public function Products()
    {
        return Product::where('available', true)->orderByDesc('id')  ->when($this->selectedCategory, function ($query) {
            $query->where('category_id', $this->selectedCategory);
        })->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }
      #[Computed()]
    public function categories()
    {
        return Category::get();
    }
    #[Layout('components.layouts.client.app')]

    public function render()
    {
        return view('livewire.client.product.index')->with([
            'products' => $this->products->paginate($this->paginate)
        ]);;
    }
}
