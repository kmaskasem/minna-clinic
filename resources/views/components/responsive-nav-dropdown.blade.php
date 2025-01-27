@props(['active'])

@php
$triggerClasses = ($active ?? false)
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-base font-semibold text-indigo-700 bg-indigo-50 focus:outline-none transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';

$contentClasses = 'space-y-1 ms-3';
@endphp

<div x-data="{ open: false }" class="w-full">
    <!-- Trigger -->
    <button @click="open = !open" :aria-expanded="open.toString()" class="{{ $triggerClasses }}">
        <div class="flex justify-between items-center">
            <span>{{ $trigger }}</span>
            <svg :class="{'rotate-180': open}" class="transition-transform duration-150 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>

    <!-- Dropdown Content -->
    <div x-show="open" x-cloak class="{{ $contentClasses }}">
        {{ $slot }}
    </div>
</div>
