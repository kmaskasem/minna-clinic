<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Faculty;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class FacultyPage extends Component
{
    use WithPagination;
    public $search;
    public $confirmFacDeletion = false;
    public $currentModal = null; // 
    public $selectedFac = null; // 

    #[Validate('')]
    public $code = '';
    #[Validate('required|string|max:255')]
    public $name = '';

    public $confirmFacCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmFacDeletion($id)
    {
        $this->confirmFacDeletion = $id;
    }

    public function deleteFac(Faculty $fac)
    {
        $fac->delete();
        $this->confirmFacDeletion = false;
    }

    public function showFaculty($id)
    {
        if (!$id)
            session()->flash('message', 'Data not found.');

        $this->selectedFac = Faculty::findOrFail($id);
        $this->code = $this->selectedFac->code;
        $this->name = $this->selectedFac->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedFac->fill($validated);

        $this->selectedFac->save();

        $this->reset(['selectedFac', 'code', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $fac = Faculty::create($validated);
        $this->reset(['code', 'name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $faculties = Faculty::where('code', 'like', '%' . $this->search . '%')
        ->orWhere('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.faculty-page', [
            'faculties' => $faculties->paginate(10)
        ]);
    }
}
