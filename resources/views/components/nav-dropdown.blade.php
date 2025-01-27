@props([
'align' => 'left',
'width' => '48',
'contentClasses' => 'py-1 bg-white',
'active' => false
])

@php
$alignmentClasses = match ($align) {
'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
'top' => 'origin-top',
'right' => 'ltr:origin-top-right rtl:origin-top-left end-0',
default => 'ltr:origin-top-left rtl:origin-top-right start-0',
};

$width = match ($width) {
'48' => 'w-48',
default => $width,
};

$classes = ($active)
? 'inline-flex items-center px-3 py-6 rounded-none border-b-2 border-indigo-400 text-sm leading-4 font-semibold text-gray-900 bg-white hover:font-semibold focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
: 'inline-flex items-center px-3 py-6 rounded-none border-b-2 border-transparent text-sm leading-4 font-medium text-gray-500 bg-white hover:text-gray-700 hover:font-semibold hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';

@endphp

<div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
<div class="flex items-center">
        <button {{ $attributes->merge(['class' => $classes]) }}>
            <span>{{ $trigger }}</span>
            <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </div>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>