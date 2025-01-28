<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                    <x-nav-link :href="route('medical-records')" :active="(request()->routeIs('medical-records') || request()->routeIs('dashboard'))" wire:navigate>
                        {{ __('เวชระเบียน') }}
                    </x-nav-link>
                    <x-nav-link :href="route('receiving-service')" :active="request()->routeIs('receiving-service')" wire:navigate>
                        {{ __('การรับบริการ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('withdraw-medicine')" :active="request()->routeIs('withdraw-medicine')" wire:navigate>
                        {{ __('เบิกยา') }}
                    </x-nav-link>
                    <!-- dropdown links -->
                    <x-nav-dropdown align="top" width="48" :active="request()->routeIs('report.*')">
                        <x-slot name="trigger">
                            {{ __('รายงาน') }}
                        </x-slot>

                        <x-slot name="content">
                            <x-nav-dropdown-link :href="route('report.one')" :active="request()->routeIs('report.one')" wire:navigate>
                                {{ __('One') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('report.two')" :active="request()->routeIs('report.two')" wire:navigate>
                                {{ __('Two') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('report.three')" :active="request()->routeIs('report.three')" wire:navigate>
                                {{ __('Three') }}
                            </x-nav-dropdown-link>
                        </x-slot>
                    </x-nav-dropdown>
                    <x-nav-dropdown align="top" width="48" :active="request()->routeIs('manage-data.*')">
                        <x-slot name="trigger">
                            {{ __('ฐานข้อมูล') }}
                        </x-slot>

                        <x-slot name="content">
                            <x-nav-dropdown-link :href="route('manage-data.faculty')" :active="request()->routeIs('manage-data.faculty')" wire:navigate>
                                {{ __('คณะ') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.org')" :active="request()->routeIs('manage-data.org')" wire:navigate>
                                {{ __('หน่วยงาน') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.ncd')" :active="request()->routeIs('manage-data.ncd')" wire:navigate>
                                {{ __('โรคประจำตัว') }}
                            </x-nav-dropdown-link>
                            <hr>
                            <x-nav-dropdown-link :href="route('manage-data.user')" :active="request()->routeIs('manage-data.user')" wire:navigate>
                                {{ __('ผู้ใช้งาน') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.staff')" :active="request()->routeIs('manage-data.staff')" wire:navigate>
                                {{ __('ผู้ให้การรักษา') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.icd10')" :active="request()->routeIs('manage-data.icd10')" wire:navigate>
                                {{ __('การวินิจฉัย') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.icd09')" :active="request()->routeIs('manage-data.icd09')" wire:navigate>
                                {{ __('หัตถการ') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.hospital')" :active="request()->routeIs('manage-data.hospital')" wire:navigate>
                                {{ __('สถานพยาบาล') }}
                            </x-nav-dropdown-link>
                            <hr>
                            <x-nav-dropdown-link :href="route('manage-data.stock')" :active="request()->routeIs('manage-data.stock')" wire:navigate>
                                {{ __('คลังย่อย') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.drug')" :active="request()->routeIs('manage-data.drug')" wire:navigate>
                                {{ __('ยา') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.medic')" :active="request()->routeIs('manage-data.medic')" wire:navigate>
                                {{ __('เวชภัณฑ์') }}
                            </x-nav-dropdown-link>
                            <x-nav-dropdown-link :href="route('manage-data.usage')" :active="request()->routeIs('manage-data.usage')" wire:navigate>
                                {{ __('วิธีใช้') }}
                            </x-nav-dropdown-link>
                        </x-slot>
                    </x-nav-dropdown>
                    <x-nav-link :href="route('contact-us')" :active="request()->routeIs('contact-us')" wire:navigate>
                        {{ __('ติดต่อเรา') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['username' => auth()->user()->username]) }}" x-text="username" x-on:profile-updated.window="username = $event.detail.username"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="py-1 space-y-1">
            <x-responsive-nav-link :href="route('medical-records')" :active="request()->routeIs('medical-records')" wire:navigate>
                {{ __('เวชระเบียน') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('receiving-service')" :active="request()->routeIs('receiving-service')" wire:navigate>
                {{ __('การรับบริการ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('withdraw-medicine')" :active="request()->routeIs('withdraw-medicine')" wire:navigate>
                {{ __('เบิกยา') }}
            </x-responsive-nav-link>
            <!-- Responsive Dropdown Menu -->
            <x-responsive-nav-dropdown :active="request()->routeIs('report.*')">
                <x-slot name="trigger">
                    {{ __('รายงาน') }}
                </x-slot>
                <x-responsive-nav-dropdown-link :href="route('report.one')" :active="request()->routeIs('report.one')" wire:navigate>
                    {{ __('One') }}
                </x-responsive-nav-dropdown-link>
                <x-responsive-nav-dropdown-link :href="route('report.two')" :active="request()->routeIs('report.two')" wire:navigate>
                    {{ __('Two') }}
                </x-responsive-nav-dropdown-link>
                <x-responsive-nav-dropdown-link :href="route('report.three')" :active="request()->routeIs('report.three')" wire:navigate>
                    {{ __('Three') }}
                </x-responsive-nav-dropdown-link>
            </x-responsive-nav-dropdown>
            <x-responsive-nav-dropdown :active="request()->routeIs('manage-data.*')">
                <x-slot name="trigger">
                    {{ __('ฐานข้อมูล') }}
                </x-slot>
                <x-responsive-nav-dropdown-link :href="route('manage-data.faculty')" :active="request()->routeIs('manage-data.faculty')" wire:navigate>
                {{ __('Faculty') }}
                </x-responsive-nav-dropdown-link>
                <x-responsive-nav-dropdown-link :href="route('manage-data.user')" :active="request()->routeIs('manage-data.user')" wire:navigate>
                {{ __('User') }}
                </x-responsive-nav-dropdown-link>
                <x-responsive-nav-dropdown-link :href="route('manage-data.drug')" :active="request()->routeIs('manage-data.drug')" wire:navigate>
                {{ __('Drug') }}
                </x-responsive-nav-dropdown-link>
            </x-responsive-nav-dropdown>
            <x-responsive-nav-link :href="route('contact-us')" :active="request()->routeIs('contact-us')" wire:navigate>
                {{ __('ติดต่อเรา') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['username' => auth()->user()->username]) }}" x-text="username" x-on:profile-updated.window="username = $event.detail.username"></div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>