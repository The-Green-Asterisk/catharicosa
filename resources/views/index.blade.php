<x-layout>
    <div class="flex">
        {{-- Category Sidebar --}}
        <div x-data="{ open: true, toggle() { this.open =! this.open } }" :class="open ? 'lg:min-w-[25%] max-w-[25%] h-screen mr-8' : 'h-fit mr-2'" class="transition-all bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-r shadow bg-white border-l-0">
            <img src="/storage/scrollicon.png" class="float-right m-3 h-6" @click="toggle()" />
            <div x-show="open" class="m-10 transition-all">
                <h1 class="text-lg underline font-bold decoration-4">Quests</h1>
                    <livewire:slider :categories="$quests" />
                <h1 class="text-lg underline font-bold decoration-4">NPCs</h1>
                    <livewire:slider :categories="$npcs" />
                <h1 class="text-lg underline font-bold decoration-4">Locations</h1>
                    <livewire:slider :categories="$locations" />
            </div>
        </div>
        {{-- Main Body --}}
        <x-panel class="h-screen lg:max-w-3/4 overflow-y-auto overflow-hidden">
            {{-- Notes --}}
            @foreach ($notes as $note)
                <div class="mx-32 my-10 transition-all">
                    <div class="flex justify-between">
                        <h2 class="font-bold">{{ $note->title }}</h2>
                        <p class="text-sm italic text-gray-400">created {{ $note->created_at->diffForHumans() }}</p>
                    </div>
                    <p>{{ $note->body }}</p>
                    @foreach ($note->notelettes as $notelette)
                        <p class="italic">{{ $notelette->body }}</p>
                    @endforeach
                </div>
            @endforeach
        </x-panel>
        {{-- Inventory Sidebar --}}
        <div x-data="{ open: true, toggle() { this.open =! this.open } }" :class="open ? 'lg:min-w-[25%] max-w-[25%] h-screen ml-8' : 'ml-2 h-fit'" class="bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-l shadow bg-white overflow-y-auto overflow-hidden border-r-0 transition-all">
            <img src="/storage/backpack.png" :class="open ? 'm-3 h-6 absolute' : 'm-3 h-6'" @click="toggle()" />
            <div x-show="open">
                <livewire:inventory />
            </div>
        </div>
    </div>
</x-layout>
