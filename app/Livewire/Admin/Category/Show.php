<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

class Show extends Component
{

    public Category $category;

    public function rules()
    {
        return [
            'category.name_fr' => 'required|string|max:255',
            'category.name_ar' => 'required|string|max:255',

        ];
    }


    public function save()
    {

        try {
            $this->validate();

            DB::transaction(function () {
                $this->category->save();
                alert()->success(__('Updated successfully'), __('Category updated successfully'));
                $this->redirectRoute('admin.category.index');
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "title" => __('Failed update'),
                "text" => __('Could not update this category'),
                'icon' => "warning"
            ]);
        }
    }
    
    #[Layout('components.layouts.admin.app')]

    public function render()
    {
        return view('livewire.admin.category.show');
    }
}
