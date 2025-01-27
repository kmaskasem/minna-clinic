<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Organization;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class OrganizationPage extends Component
{
    use WithPagination;
    public $search;
    public $confirmOrgDeletion = false;
    public $currentModal = null; // 
    public $selectedOrg = null; // 

    #[Validate('')]
    public $code = '';
    #[Validate('required|string|max:255')]
    public $name = '';

    public $confirmOrgCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmOrgDeletion($id)
    {
        $this->confirmOrgDeletion = $id;
    }

    public function deleteOrg(Organization $org)
    {
        $org->delete();
        $this->confirmOrgDeletion = false;
    }

    public function showOrganization($id)
    {
        if (!$id) {
            session()->flash('message', 'Data not found.');
        }

        $this->selectedOrg = Organization::findOrFail($id);
        $this->code = $this->selectedOrg->code;
        $this->name = $this->selectedOrg->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedOrg->fill($validated);

        $this->selectedOrg->save();

        $this->reset(['selectedOrg', 'code', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $org = Organization::create($validated);
        $this->reset(['code', 'name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $organizations = Organization::where('code', 'like', '%' . $this->search . '%')
        ->orWhere('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.organization-page', [
            'organizations' => $organizations->paginate(10)
        ]);
    }
}
