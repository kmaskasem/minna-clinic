<?php

namespace App\Livewire\Pages\ManageData;

use App\Models\Base\Drug;
use Livewire\Component;

class DrugPage extends Component
{
    public $search;

    public function render()
    {
        $drugs = Drug::where('code', 'like', '%' . $this->search . '%')
        ->orWhere('name', 'like', '%' . $this->search . '%');

        return view('livewire.pages.manage-data.drug-page',[
            'drugs' => $drugs->paginate(10)   
        ]);
    }
}
