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
        <section class="flex flex-col grow bg-center bg-cover bg-no-repeat bg-[url('/public/img/exterior.jpg')] bg-gray-500 bg-blend-multiply">
            <div class="flex flex-col grow justify-evenly spx-4 space-y-6 mx-auto max-w-screen-xl pt-24 pb-12">
                <div class="flex flex-col text-center grow justify-center">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-wide leading-none text-white md:text-5xl lg:text-6xl">Montel</h1>
                    <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl px-4 sm:px-16 lg:px-48">Your Premier Destination for Unforgettable Stays in Montreal</p>
                </div>
                <div class="flex flex-col-reverse bg-gray-50 rounded-lg max-w-7xl mx-6 py-6 px-4 sm:px-6 lg:px-8">
                    <x-search-form>{{ __('Check Availability') }}</x-search-form> 
                </div>
            </div>
        </section>
</x-app-layout>