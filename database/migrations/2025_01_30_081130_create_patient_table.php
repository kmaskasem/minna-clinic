<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('_patient', function (Blueprint $table) {
            $table->id();
            $table->dateTime('recorded_at', precision: 0)->nullable();
            $table->string('profile_picture')->nullable();
            $table->tinyInteger('patient_type')->nullable()->default(0);
            $table->string('code_no')->nullable();
            $table->string('id_card_number')->nullable();
            $table->string('student_id')->nullable();
            $table->tinyInteger('title')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->foreignId('org_id')->nullable()->constrained('_org')->onDelete('set null');
            $table->string('position_type')->nullable();
            $table->foreignId('fac_id')->nullable()->constrained('_fac')->onDelete('set null');
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('healthcare_code')->nullable();
            $table->date('birthday')->nullable();
            $table->text('medical_history')->nullable();
            $table->tinyInteger('smoking_freq')->nullable();
            $table->tinyInteger('alcohol_freq')->nullable();
            $table->text('health_cond')->nullable(); //โรคประจำตัว
            $table->string('blood_type')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('internal_phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('_patient_drug_allergy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('_patient')->onDelete('cascade');
            $table->string('drug');
            $table->string('allergy_symptoms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_patient_drug_allergy');
        Schema::dropIfExists('_patient');
    }
};
