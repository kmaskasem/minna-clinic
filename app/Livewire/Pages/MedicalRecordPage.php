<?php

namespace App\Livewire\Pages;

use Illuminate\Validation\Rule;
use App\Enums\AlcoholFreq;
use App\Enums\Gender;
use App\Enums\HealthcareCode;
use App\Enums\PatientType;
use App\Enums\Position;
use App\Enums\SmokingFreq;
use App\Enums\Title;
use App\Models\Base\Faculty;
use App\Models\Base\Organization;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class MedicalRecordPage extends Component
{
    use WithPagination;
    public $search, $search_type, $search_healthcode, $search_date, $search_gender = '';
    // public $patientType, $genders, $titles, $healthcareCode, $smokingFreq, $alcoholFreq, $faculites, $orgs, $positions = [];
    public $patient_type, $profile_picture, $code_no, $id_card_number, $student_id, $title, $firstname, $lastname, $gender, $healthcare_code, $birthday, $medical_history, $smoking_freq, $alcohol_freq, $health_cond, $mobile_number, $email;

    // public function mount()
    // {
    //     $this->patientType = PatientType::options();
    //     $this->genders = Gender::options();
    //     $this->titles = Title::options();
    //     $this->faculites = Faculty::pluck('name', 'id');
    //     $this->orgs = Organization::pluck('name', 'id');
    //     $this->positions = Position::options();
    //     $this->healthcareCode = HealthcareCode::options();
    //     $this->smokingFreq = SmokingFreq::options();
    //     $this->alcoholFreq = AlcoholFreq::options();
    // }

    public function create()
    {

        $validated = $this->validate(Patient::rules());

        Patient::create($validated);

        $this->reset();
        // $this->reset(['code', 'name']);

        $this->dispatch('close-modal', 'create-modal');

        // session()->flash('message', 'เพิ่มผู้ป่วยใหม่สำเร็จ!');
        $this->render();
    }

    public function updating($property)
    {
        if (in_array($property, ['search', 'search_type', 'search_healthcode', 'search_date', 'search_gender'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $patients = Patient::orderBy('code_no', 'desc');

        if ($this->search_type) $patients->where('patient_type', $this->search_type);
        if ($this->search_healthcode) $patients->where('healthcare_code', $this->search_healthcode);
        if ($this->search_date) $patients->where('created_at', 'like', '%' . $this->search_date . '%');
        if ($this->search_gender) $patients->where('gender', $this->search_gender);
        if ($this->search) $patients->where('code_no', 'like', '%' . $this->search . '%')
            ->orWhere('id_card_number', 'like', '%' . $this->search . '%')
            ->orWhere('firstname', 'like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%');
        $patientType = PatientType::options();
        $genders = Gender::options();
        $titles = Title::options();
        $faculites = Faculty::pluck('name', 'id');
        $orgs = Organization::pluck('name', 'id');
        $positions = Position::options();
        $healthcareCode = HealthcareCode::options();
        $smokingFreq = SmokingFreq::options();
        $alcoholFreq = AlcoholFreq::options();
        $this->code_no = Patient::getNextNumber();

        return view('livewire.pages.medical-record-page', [
            'patients' => $patients->paginate(10),
            'patientType' => $patientType,
            'genders' => $genders,
            'titles' => $titles,
            'faculites' => $faculites,
            'orgs' => $orgs,
            'positions' => $positions,
            'healthcareCode' => $healthcareCode,
            'smokingFreq' => $smokingFreq,
            'alcoholFreq' => $alcoholFreq,
        ]);
    }
}
