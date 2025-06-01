<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
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
    #[Computed()]
    public function Categories()
    {
        return Category::orderByDesc('id')->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }
    #[On('delete')]
    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            $this->dispatch('show-toast-alert', [
                "text" => __('Category deleted successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not delete this Category!'),
                'icon' => "warning"
            ]);
        }
    }
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.category.index')->with([
            'categories' => $this->categories->paginate($this->paginate)
        ]);;
    }
}
