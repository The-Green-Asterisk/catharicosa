<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>Catharicosa Notes</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .menu {
                width: 120px;
                z-index: 100;
                position: fixed;
                display: none;
                transition: 0.2s display ease-in;

                .menu-options {
                    list-style: none;
                    padding: 10px 0;
                    z-index: 100;

                    .menu-option {
                        font-weight: 500;
                        z-index: 1;
                        font-size: 14px;
                        padding: 10px 40px 10px 20px;
                        cursor: pointer;

                            &:hover {
                                background: rgba(0, 0, 0, 0.2);
                            }
                        }
                    }
                }
        </style>

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>

        @livewireStyles
    </head>
    <x-loading />
    <body class="bg-gradient-to-br from-stone-100 to-slate-200 bg-fixed">
        <div name="header" class="w-screen flex justify-between content-center">
            <a href="/"><img src="/catharicosa-logo.png" class="h-28 m-5" /></a>
            <div class="flex flex-col justify-center text-center mr-10">
                @auth
                    <span>Welcome, {{ auth()->user()->name }}</span>
                @else
                    <x-anchor-button href="/register">Sign Up</x-anchor-button>
                @endauth
                <livewire:session />
            </div>
        </div>
        {{ $slot }}
        @if (session()->has('success'))
            <div x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 5000)"
                x-show="show"
                class="w-screen h-screen absolute sticky inset-0 z-40 backdrop-blur flex content-center">
                <x-panel @click.away="show = false" class="z-50 w-72 p-4 font-bold text-center">{!! session('success') !!}</x-panel>
            </div>
        @endif
        @livewireScripts
    </body>
</html>
