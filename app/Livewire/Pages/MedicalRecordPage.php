<?php

namespace App\Livewire\Pages;

use Illuminate\Validation\Rule;
use App\Enums\AlcoholFreq;
use App\Enums\Gender;
use App\Enums\HealthcareCode;
use App\Enums\PatientType;
use App\Enums\SmokingFreq;
use App\Enums\Title;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class MedicalRecordPage extends Component
{
    use WithPagination;
    public $search, $searchQuery = '';
    public $patientType, $genders, $titles, $healthcareCode, $smokingFreq, $alcoholFreq = [];
    public $patient_type, $profile_picture, $code_no, $id_card_number, $title, $firstname, $lastname, $gender, $healthcare_code, $birthday, $medical_history, $smoking_freq, $alcohol_freq, $health_cond, $mobile_number, $email;

    public function mount()
    {
        $this->patientType = PatientType::options();
        $this->genders = Gender::options();
        $this->titles = Title::options();
        $this->healthcareCode = HealthcareCode::options();
        $this->smokingFreq = SmokingFreq::options();
        $this->alcoholFreq = AlcoholFreq::options();
    }

    public function create()
    {
        //     $validated = $this->validate([
        //         // 'recorded_at' => '',
        //         // 'profile_picture' => '',
        //         'patient_type' => '',
        //         'code_no' => 'required',
        //         'id_card_number' => '',
        //         // 'student_id' => '',
        //         'title' => ['required', Rule::in(array_keys($this->titles))],
        //         'firstname' => 'required|string|max:255',
        //         'lastname' => 'required|string|max:255',
        //         // 'org_id' => '',
        //         // 'position_type' => '',
        //         // 'fac_id' => '',
        //         'gender' => ['required', Rule::in(array_keys($this->genders))],
        //         'healthcare_code' => ['required', Rule::in(array_keys($this->healthcareCode))],
        //         'birthday' => 'required',
        //         'medical_history' => '',
        //         'smoking_freq' => ['required', Rule::in(array_keys($this->smokingFreq))],
        //         'alcohol_freq' => ['required', Rule::in(array_keys($this->alcoholFreq))],
        //         'health_cond' => '',
        //         'mobile_number' => '',
        //         // 'internal_phone' => '',
        //         'email' => 'nullable|email',
        //     ]);

        $validated = $this->validate([
            // 'recorded_at' => '',
            // 'profile_picture' => '',
            'patient_type' => '',
            'code_no' => '',
            'id_card_number' => '',
            // 'student_id' => '',
            'title' => '',
            'firstname' => '',
            'lastname' => '',
            // 'org_id' => '',
            // 'position_type' => '',
            // 'fac_id' => '',
            'gender' => '',
            // 'healthcare_code' => ['required', Rule::in(array_keys($this->healthcareCode))],
            // 'birthday' => 'required',
            // 'medical_history' => '',
            // 'smoking_freq' => ['required', Rule::in(array_keys($this->smokingFreq))],
            // 'alcohol_freq' => ['required', Rule::in(array_keys($this->alcoholFreq))],
            // 'health_cond' => '',
            // 'mobile_number' => '',
            // // 'internal_phone' => '',
            // 'email' => 'nullable|email',
        ]);

        Patient::create($validated);

        $this->reset();
        // $this->reset(['code', 'name']);

        $this->dispatch('close-modal', 'create-modal');

        session()->flash('message', 'เพิ่มผู้ป่วยใหม่สำเร็จ!');
        $this->render();
    }

    public function render()
    {
        $patients = Patient::where('code_no', 'like', '%' . $this->search . '%')
            ->orWhere('id_card_number', 'like', '%' . $this->search . '%')
            ->orWhere('firstname', 'like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%');

        return view('livewire.pages.medical-record-page', [
            'patients' => $patients->paginate(10),
            'patientType' => $this->patientType,
            'genders' => $this->genders,
            'titles' => $this->titles,
            'healthcareCode' => $this->healthcareCode,
            'smokingFreq' => $this->smokingFreq,
            'alcoholFreq' => $this->alcoholFreq,
        ]);
    }
}
