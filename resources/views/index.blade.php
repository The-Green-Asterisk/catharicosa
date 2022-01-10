<x-layout>
    @auth
        <div class="flex">
            {{-- Category Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open }}"
                :class="open ? 'lg:min-w-[25%] lg:max-w-[25%] md:w-72 w-full h-screen mr-8' : 'h-fit mr-2'"
                class="sidebar absolute lg:static transition-all bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-r shadow-lg bg-white overflow-y-auto overflow-hidden border-l-0 z-10 transition-all"
                @resize.window="width = (window.innerWidth > 0) ? window.innerWidth : screen.width; if (width < 1020) {open = false}else{open = true}"
                x-init="width = (window.innerWidth > 0) ? window.innerWidth : screen.width; if (width < 1020) {open = false}else{open = true}" x-transition.scale>
                <img src="images/scrollicon.png" :class="open ? 'md:mr-3 mr-14' : ''" class="float-right m-3 h-6 cursor-pointer" @click="toggle()" />
                <div x-show="open" class="m-10 transition-all duration-1000">
                    <a href="/item" class="mx-auto border border-slate-500 shrink-0 bg-slate-200 rounded text-center font-black w-7 h-7 flex flex-col justify-center shadow text-slate-500 hover:bg-slate-300 active:bg-slate-400 cursor-pointer" title="New Journal Entry">+</a>
                    <h1 class="text-lg underline font-bold decoration-4">Quests</h1>
                        <livewire:slider :categories="$quests" :catName="'quests'" />
                    <h1 class="text-lg underline font-bold decoration-4">NPCs</h1>
                        <livewire:slider :categories="$npcs" :catName="'npcs'" />
                    <h1 class="text-lg underline font-bold decoration-4">Locations</h1>
                        <livewire:slider :categories="$locations" :catName="'locations'" />
                </div>
            </div>
            {{-- Main Body --}}
            <x-panel class="h-screen lg:w-3/4 overflow-y-auto overflow-hidden flex-col" id="notes">
                {{-- Notes --}}
                <livewire:new-note />
                @foreach ($notes as $note)
                    <div x-data="{ open: false, toggle() { this.open =! this.open } }" class="lg:mx-10 2xl:mx-32 md:mx-32 mx-10 my-10 transition-all" x-on:mouseleave="open = false">
                        <div class="flex items-center space-x-2">
                            <h2 class="font-bold">{{ $note->title }}</h2>
                            <div class="grow"></div>
                            <p class="text-sm italic text-gray-400">created {{ $note->created_at->diffForHumans() }}</p>
                            <form method="POST" id="{{ 'delete' . $note->id }}" action="/note/{{ $note->id }}/delete">
                                @csrf
                                @method('DELETE')
                                <input type="image" src="images/trash.png" alt="Delete" height="15px" width="15px" class="opacity-50 hover:opacity-100" title="Delete Note" />
                            </form>
                        </div>
                        <form action="/notes/{{ $note->id }}/notelette" id="notelette" method="POST" x-data="noteletteForm()" @contextmenu="formData.body = window.getSelection().toString()" @submit.prevent="submitData">
                            @csrf
                            <div class="note" @contextmenu="formData.note_id = {{ $note->id }};$event.preventDefault();toggle()">
                                @foreach ($note->notelettes as $notelette)
                                    @php
                                        $noteletteBodies[] = "/$notelette->body/";
                                        $replacements[] = "<span class='italic bg-red-100 rounded border border-red-300'>$notelette->body</span>";
                                    @endphp
                                @endforeach
                                @if (isset($noteletteBodies))
                                    {!! preg_replace($noteletteBodies, $replacements, $note->body) !!}
                                @else
                                    {!! $note->body !!}
                                @endif
                            </div>
                            <p x-text="message" class="text-xs text-red-600"></p>
                            <x-notelette-menu
                                :quests="$quests" :npcs="$npcs" :locations="$locations" :inventoryItems="$inventoryItems" />
                        </form>
                        @foreach ($note->notelettes as $notelette)
                            <x-notelette :notelette="$notelette" />
                        @endforeach
                    </div>
                @endforeach
            </x-panel>
            {{-- Inventory Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open }}"
                :class="open ? 'lg:min-w-[25%] lg:max-w-[25%] md:w-min w-full h-screen ml-8' : 'ml-2 h-fit'"
                class="absolute lg:static right-0 bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-l shadow-lg bg-white overflow-y-auto overflow-hidden border-r-0 z-10 transition-all"
                @resize.window="width = (window.innerWidth > 0) ? window.innerWidth : screen.width; if (width < 1020) {open = false}else{open = true}"
                x-init="width = (window.innerWidth > 0) ? window.innerWidth : screen.width; if (width < 1020) {open = false}else{open = true}" x-transition.scale>
                <img src="images/backpack.png" :class="open ? 'm-3 h-6 absolute' : 'm-3 h-6'" @click="toggle()" class="cursor-pointer" />
                <div x-show="open" class="transition-all duration-1000">
                    <livewire:inventory :catName="'inventory-items'" />
                </div>
            </div>
        </div>
    @else
    {{-- Guest view --}}
        <div class="bg-white bg-fixed bg-no-repeat flex justify-center shadow-inner hidden md:visible" style="background-image: url('images/wizard.jpg');padding-left:736px;">
            <img src="images/hero-logo.png" class="h-96" />
        </div>
        <img src="images/hero-logo.png" class="md:hidden" />
        <div class="text-3xl font-bold text-center m-10">Note-taking app for the meticulous tabletop player</div>

        <div class="flex justify-evenly">
            <div class="w-96 text-xl">Write notes as usual and then highlight details to mark them as "notelettes"</div>
            <div class="w-96 text-xl">Attach notelettes to NPCs, Locations, or Quests</div>
            <div class="w-96 text-xl">Easily access notelettes later when looking for details about specific NPCs, Locations, or Quests</div>
        </div>
    @endauth
</x-layout>
