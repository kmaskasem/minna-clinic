<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Staff;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class StaffPage extends Component
{
    use WithPagination;
    public $search;
    public $confirmStfDeletion = false;
    public $currentModal = null; // 
    public $selectedStf = null; // 

    #[Validate('required|string|max:255')]
    public $name = '';

    public $confirmStfCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmStfDeletion($id)
    {
        $this->confirmStfDeletion = $id;
    }

    public function deleteStf(Staff $stf)
    {
        $stf->delete();
        $this->confirmStfDeletion = false;
    }

    public function showStaff($id)
    {
        if (!$id) {
            session()->flash('message', 'Data not found.');
        }

        $this->selectedStf = Staff::findOrFail($id);
        $this->name = $this->selectedStf->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedStf->fill($validated);

        $this->selectedStf->save();

        $this->reset(['selectedStf', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $stf = Staff::create($validated);
        $this->reset(['name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $staffs = Staff::where('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.staff-page', [
            'staffs' => $staffs->paginate(10)
        ]);
    }
}
