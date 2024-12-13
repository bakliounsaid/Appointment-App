<?php

namespace App\Livewire\Admin\Franchise;

use App\Models\Country;
use App\Models\Franchise;
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

    #[Computed]
    public function franchises()
    {
        return Franchise::orderByDesc('id')->when(trim($this->search) != "", function ($query) {
            $query->search(trim($this->search));
        });
    }

    #[On('delete')]
    public function delete($id)
    {
        try {
            $franchise = Franchise::findOrFail($id);
            $franchise->franchiseAdmins()->delete();

            foreach ($franchise->agencies as $agency) {
                $agency->agencyAdmins()->delete();
                $agency->delete();
            }

            $franchise->delete();

            $this->dispatch('show-toast-alert', [
                "text" => __('Item deleted successfully!'),
                'icon' => "success"
            ]);
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
            $this->dispatch('show-toast-alert', [
                "text" => __('Could not delete this item!'),
                'icon' => "warning"
            ]);
        }
    }

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.franchise.index')->with([
            'franchises' => $this->franchises->paginate($this->paginate)
        ]);
    }
}
