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
        Schema::create('_fac', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
        });

        Schema::create('_org', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
        });
        
        Schema::create('_ncd', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        Schema::create('_icd9', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name_th')->nullable();
            $table->string('name_en')->nullable();
        });

        Schema::create('_icd10', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name_th')->nullable();
            $table->string('name_en')->nullable();
        });

        Schema::create('_stf', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        Schema::create('_hos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        Schema::create('_stock', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        Schema::create('_drug', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('catagory')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price')->nullable()->default(0.00);
            $table->string('unit')->nullable();
            $table->string('unitf')->nullable();
            $table->string('prices')->nullable();
            $table->string('units')->nullable();
            $table->string('description')->nullable();
        });

        Schema::create('_medsup', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('catagory')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price')->nullable()->default(0.00);
            $table->string('unit')->nullable();
            $table->string('unitf')->nullable();
            $table->string('prices')->nullable();
            $table->string('units')->nullable();
            $table->string('description')->nullable();
        });

        Schema::create('_usg', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_fac');
        Schema::dropIfExists('_org');
        Schema::dropIfExists('_ncd');
        Schema::dropIfExists('_icd9');
        Schema::dropIfExists('_icd10');
        Schema::dropIfExists('_stf');
        Schema::dropIfExists('_hos');
        Schema::dropIfExists('_stock');
        Schema::dropIfExists('_drug');
        Schema::dropIfExists('_medsup');
        Schema::dropIfExists('_usg');
    }
};
