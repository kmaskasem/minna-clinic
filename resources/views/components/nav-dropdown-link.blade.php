@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 text-start text-sm font-bold leading-5 text-gray-900 bg-indigo-300 hover:bg-gray-100 hover:font-bold focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 text-start text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:font-bold hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>