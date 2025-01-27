<?php

use App\Livewire\Pages\ManageData\UserPage;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Volt::route('/', 'pages.auth.login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('medical-records', 'medical-records')->name('medical-records');
    Route::view('receiving-service', 'receiving-service')->name('receiving-service');
    Route::view('withdraw-medicine', 'withdraw-medicine')->name('withdraw-medicine');
    Route::view('contact-us', 'contact-us')->name('contact-us');
});

Route::prefix('manage-data')->middleware(['auth', 'verified'])->name('manage-data.')->group(function () {
    Route::view('/drug', 'manage-data.drugs')->name('drug');
    Route::view('/faculty', 'manage-data.faculties')->name('faculty');
    Route::view('/hospital', 'manage-data.hospitals')->name('hospital');
    Route::view('/icd09', 'manage-data.icd09s')->name('icd09');
    Route::view('/icd10', 'manage-data.icd10s')->name('icd10');
    Route::view('/medic', 'manage-data.medicalspplies')->name('medic');
    Route::view('/medic', 'manage-data.medicalspplies')->name('medic');
    Route::view('/ncd', 'manage-data.ncds')->name('ncd');
    Route::view('/org', 'manage-data.organizations')->name('org');
    Route::view('/staff', 'manage-data.staffs')->name('staff');
    Route::view('/stock', 'manage-data.stocks')->name('stock');
    Route::view('/usage', 'manage-data.usages')->name('usage');
    Route::view('/user', 'manage-data.users')->name('user');
});

Route::prefix('report')->middleware(['auth', 'verified'])->name('report.')->group(function () {
    Route::view('/one', 'report.one')->name('one');
    Route::view('/two', 'report.two')->name('two');
    Route::view('/three', 'report.three')->name('three');
    // Route::view('/dashboard3', 'dashboard3')->name('dashboard3');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
