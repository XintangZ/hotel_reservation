<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content="Welcome to Montel, a luxurious hotel offering premium accommodation and amenities. Book your stay now!">
        <meta name="keywords" content="hotel, luxury hotel, accommodation, travel, hospitality">
        <meta name="author" content="Xintang Zhang">
        
        <!-- Page Title -->
        <title>Montel - Luxury Accommodation</title>

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="www.montel.com">
        <meta property="og:title" content="Montel - Luxury Accommodation">
        <meta property="og:description" content="Welcome to Montel, a luxurious hotel offering premium accommodation and amenities. Book your stay now!">
        <meta property="og:image" content="/img/logo.png">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="www.montel.com">
        <meta property="twitter:title" content="Montel - Luxury Accommodation">
        <meta property="twitter:description" content="Welcome to Montel, a luxurious hotel offering premium accommodation and amenities. Book your stay now!">
        <meta property="twitter:image" content="/img/logo.png">
    </x-slot>

    <x-slot name="scripts">
        @vite(['resources/js/search.js'])
    </x-slot>

    <x-slot name="header">
        <x-search-form>{{ __('Check Availability') }}</x-search-form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- TODO: weather forecast -->
        </div>
    </div>
</x-app-layout>