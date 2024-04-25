<x-app-layout>
    <x-slot name="title">
        {{ __('Home') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('reservation.create') }}">New reservation</a>
        </div>
    </div>
</x-app-layout>