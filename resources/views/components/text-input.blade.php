@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-600 text-gray-800']) !!}>
