<x-app-layout>
    <x-slot name="title">
        {{ __("Home") }}
    </x-slot>

    <x-slot name="header">
        <x-search-form 
            action="{{ route('reservation.create') }}" 
        />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img class="w-full" src="img/exterior.jpg" alt="">
        </div>
    </div>
</x-app-layout>

<!-- TODO: add content to home page -->