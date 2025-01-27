<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\NCD;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class NCDPage extends Component
{
    use WithPagination;
    public $search;
    public $confirmNcdDeletion = false;
    public $currentModal = null; // 
    public $selectedNcd = null; // 

    #[Validate('required|string|max:255')]
    public $name = '';

    public $confirmNcdCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmNcdDeletion($id)
    {
        $this->confirmNcdDeletion = $id;
    }

    public function deleteNcd(NCD $ncd)
    {
        $ncd->delete();
        $this->confirmNcdDeletion = false;
    }

    public function showNCD($id)
    {
        if (!$id) {
            session()->flash('message', 'Data not found.');
        }

        $this->selectedNcd = NCD::findOrFail($id);
        $this->name = $this->selectedNcd->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedNcd->fill($validated);

        $this->selectedNcd->save();

        $this->reset(['selectedNcd', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $ncd = NCD::create($validated);
        $this->reset(['name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $ncds = NCD::where('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.ncd-page', [
            'ncds' => $ncds->paginate(10)
        ]);
    }
}

