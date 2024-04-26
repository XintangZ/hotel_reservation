<x-app-layout>
    <x-slot name="title">
        {{ __("Home") }}
    </x-slot>

    <x-slot name="header">
        @include('layouts.search_form')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- <x-success-alert class="isolate absolute top-0 left-0 right-0" :reservationId="123">success</x-success-alert> -->

            <img class="w-full" src="img/exterior.jpg" alt="">
        </div>
    </div>
</x-app-layout>

// TODO: add content to home page