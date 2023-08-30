<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">

        <title>Catharicosa Notes | Note-taking app for TTRPGs</title>
        <meta name="description" content="Note-taking app for the fastidous and meticulous table-top RPG player. Save sections of notes as notelettes to easily reference later intead of flipping back dozens of pages to find context.">
        <meta name="keywords" content="D&D, DnD, RPG, TTRPG, notes, Dungeons and Dragon, Call of Cthulhu, Blades in the Dark, Warhammer Fantasy Roleplay, Deadlands, Cyberpunk, Paranoia, Shadow of the Demon Lord, Legend of the Five Rings Roleplaying Game, Star Wars Roleplaying Game, Pathfinder, Critical Role, Roll20, D&D Beyond, DnD Beyond, Dimension 20, Dimension20">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <link rel="icon" type="image/png" href="/favicon.png" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />
        <link href="/manifest.json" rel="manifest" />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="/long-press-event.min.js"></script>
        <script src="/app.js"></script>
        <script src="/moment.js"></script>
        <script src="/moment-timezone-with-data.js"></script>

        <script>
            if (navigator && navigator.serviceWorker) {
                navigator.serviceWorker.register('/sw.js');
            }
        </script>

        <link rel="stylesheet" href="/app.css">
        @livewireStyles
    </head>
    <x-loading />
    <body class="bg-gradient-to-br from-stone-100 to-slate-100 bg-fixed">
        <div name="header" class="w-full flex justify-between content-center flex-wrap">
            <div class="w-1/2 md:w-auto"><a href="/"><img src="/images/catharicosa-logo.png" class="h-28 w-28 m-5" /></a></div>
            @livewire('search-bar')
            <div class="flex flex-col justify-evenly text-right md:mr-10 w-1/2 md:w-auto">
                @auth
                    <span class="whitespace-nowrap">Welcome, {{ auth()->user()->name }}!</span>
                    <a href="/help" class="hover:underline whitespace-nowrap">Help</a>
                    <a href="mailto:catharicosa-support@thegreenasterisk.com" class="hover:underline whitespace-nowrap">Get Support</a>
                @else
                    <x-anchor-button href="/register" class="whitespace-nowrap ml-auto">Sign Up</x-anchor-button>
                @endauth
                <livewire:session />
            </div>
        </div>
        {{ $slot }}
        @if (session()->has('success'))
            <div x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                class="w-full h-screen absolute sticky inset-0 z-50 backdrop-blur flex content-center">
                <x-panel @click.away="show = false" class="w-72 p-4 font-bold text-center">{!! session('success') !!}</x-panel>
            </div>
        @endif
        @livewireScripts
        @livewire('modal')
        @livewire('notelette-editor')
    </body>
</html>
