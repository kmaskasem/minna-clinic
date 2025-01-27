<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\ICD10;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class ICD10Page extends Component
{
    use WithPagination;
    public $search;
    public $confirmI9Deletion = false;

    public $selectedI9 = null; // 

    #[Validate('')]
    public $code = '';
    #[Validate('required|string|max:255')]
    public $name_th = '';
    #[Validate('')]
    public $name_en = '';

    public $confirmI9Creation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmI9Deletion($id)
    {
        $this->confirmI9Deletion = $id;
    }

    public function deleteFac(ICD10 $fac)
    {
        $fac->delete();
        $this->confirmI9Deletion = false;
    }

    public function showICD10($id)
    {
        if (!$id)
            session()->flash('message', 'Data not found.');

        $this->selectedI9 = ICD10::findOrFail($id);
        $this->code = $this->selectedI9->code;
        $this->name_th = $this->selectedI9->name_th;
        $this->name_en = $this->selectedI9->name_en;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedI9->fill($validated);

        $this->selectedI9->save();

        $this->reset(['selectedI9', 'code', 'name_th', 'name_en']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $fac = ICD10::create($validated);
        $this->reset(['code', 'name_th', 'name_en']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {       
         $icd10s = ICD10::where('code', 'like', '%' . $this->search . '%')
         ->orWhere('name_th', 'like', '%' . $this->search . '%')
         ->orWhere('name_en', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.icd10-page', [
            'icd10s' => $icd10s->paginate(10)
        ]);
    }
}
