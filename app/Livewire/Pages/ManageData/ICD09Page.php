<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\ICD09;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class ICD09Page extends Component
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

    public function deleteFac(ICD09 $fac)
    {
        $fac->delete();
        $this->confirmI9Deletion = false;
    }

    public function showICD09($id)
    {
        if (!$id)
            session()->flash('message', 'Data not found.');

        $this->selectedI9 = ICD09::findOrFail($id);
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
        $fac = ICD09::create($validated);
        $this->reset(['code', 'name_th', 'name_en']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {       
         $icd09s = ICD09::where('code', 'like', '%' . $this->search . '%')
         ->orWhere('name_th', 'like', '%' . $this->search . '%')
         ->orWhere('name_en', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.icd09-page', [
            'icd09s' => $icd09s->paginate(10)
        ]);
    }
}
