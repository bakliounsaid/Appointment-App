<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

class Create extends Component
{
    public $nameFr;
    public $nameAr;

    public function rules()
    {
        return [
            'nameFr' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
        ];
    }


    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                Category::create([
                    'name_ar' => $this->nameAr,
                    'name_fr' => $this->nameFr,
                ]);

                alert()->success(__('Created successfully'), __('Category created successfully'));
                $this->redirectRoute('admin.category.index');
            });
        } catch (Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('showAlert', [
                "title" => __('Failed creation'),
                "text" => __('Could not create this category'),
                'icon' => "warning"
            ]);
        }
    }



    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.category.create');
    }
}
