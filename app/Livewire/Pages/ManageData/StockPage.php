<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Stock;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class StockPage extends Component
{
    use WithPagination;
    public $search;
    public $confirmStkDeletion = false;
    public $currentModal = null; // 
    public $selectedStk = null; // 

    #[Validate('required|string|max:255')]
    public $name = '';

    public $confirmStkCreation = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmStkDeletion($id)
    {
        $this->confirmStkDeletion = $id;
    }

    public function deleteStk(Stock $stk)
    {
        $stk->delete();
        $this->confirmStkDeletion = false;
    }

    public function showStock($id)
    {
        if (!$id) {
            session()->flash('message', 'Data not found.');
        }

        $this->selectedStk = Stock::findOrFail($id);
        $this->name = $this->selectedStk->name;
        $this->dispatch('open-modal', 'edit-modal');
    }

    public function update()
    {
        $validated = $this->validate();

        $this->selectedStk->fill($validated);

        $this->selectedStk->save();

        $this->reset(['selectedStk', 'name']);
        $this->dispatch('close-modal', 'edit-modal');

        $this->render();
    }

    public function create()
    {
        $validated = $this->validate();
        $stk = Stock::create($validated);
        $this->reset(['name']);

        $this->dispatch('close-modal', 'create-modal');
        $this->render();
    }

    public function render()
    {
        $stocks = Stock::where('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.stock-page', [
            'stocks' => $stocks->paginate(10)
        ]);
    }
}
