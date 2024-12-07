@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'px-4 py-2 bg-black text-white text-sm font-medium leading-5 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition duration-150 ease-in-out'
                : 'px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium leading-5 rounded-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-150 ease-in-out';
@endphp

<a  {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
