<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Hospital;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class HospitalPage extends Component
{
    use WithPagination;
    public $search;
    public $confirmHosDeletion = false;
    public $currentModal = null; // 
    public $selectedHos = null; // 

    #[Validate('required|string|max:255')]
    public $name = '';

    public $confirmHosCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmHosDeletion($id)
    {
        $this->confirmHosDeletion = $id;
    }

    public function deleteHos(Hospital $hos)
    {
        $hos->delete();
        $this->confirmHosDeletion = false;
    }

    public function showHospital($id)
    {
        if (!$id) {
            session()->flash('message', 'Data not found.');
        }

        $this->selectedHos = Hospital::findOrFail($id);
        $this->name = $this->selectedHos->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedHos->fill($validated);

        $this->selectedHos->save();

        $this->reset(['selectedHos', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $hos = Hospital::create($validated);
        $this->reset(['name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $hospitals = Hospital::where('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.hospital-page', [
            'hospitals' => $hospitals->paginate(10)
        ]);
    }
}
