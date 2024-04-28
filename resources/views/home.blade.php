<x-app-layout>
    <x-slot name="title">
        {{ __("Home") }}
    </x-slot>

    <x-slot name="header">
        <x-search-form />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- TODO: weather forecast -->
        </div>
    </div>
</x-app-layout>