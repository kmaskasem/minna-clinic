<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class MedicalRecordPage extends Component
{
    public $search, $patientType='new' ,$searchQuery ='';


    public function render()
    {
        return view('livewire.pages.medical-record-page');
    }
}
