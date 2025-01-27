<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Usage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class UsagePage extends Component
{
    use WithPagination;
    public $search;
    public $confirmUsgDeletion = false;
    public $currentModal = null; // 
    public $selectedUsg = null; // 

    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('')]
    public $description = '';

    public $confirmUsgCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmUsgDeletion($id)
    {
        $this->confirmUsgDeletion = $id;
    }

    public function deleteUsg(Usage $usg)
    {
        $usg->delete();
        $this->confirmUsgDeletion = false;
    }

    public function showUsage($id)
    {
        if (!$id)
            session()->flash('message', 'Data not found.');

        $this->selectedUsg = Usage::findOrFail($id);
        $this->description = $this->selectedUsg->description;
        $this->name = $this->selectedUsg->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedUsg->fill($validated);

        $this->selectedUsg->save();

        $this->reset(['selectedUsg', 'description', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $usg = Usage::create($validated);
        $this->reset(['description', 'name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $usages = Usage::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('description', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.usage-page', [
            'usages' => $usages->paginate(10)
        ]);
    }
}
