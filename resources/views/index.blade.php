
<x-layout>
    @auth
    <livewire:notebook-switch />
        <div class="flex">
            {{-- Category Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open }}"
                :class="open ? 'lg:min-w-[25%] lg:max-w-[25%] md:w-72 w-full h-screen mr-8' : 'h-fit mr-2'"
                class="sidebar absolute lg:static transition-all bg-gradient-to-br from-white via-white to-gray-100 border border-gray-300 rounded-r shadow-lg bg-white border-l-0 z-10 transition-all"
                @resize.window="width = (window.innerWidth > 0) ? window.innerWidth : screen.width; if (width < 1020) {open = false}else{open = true}"
                x-init="width = (window.innerWidth > 0) ? window.innerWidth : screen.width; if (width < 1020) {open = false}else{open = true}" x-transition.scale>
                <img src="images/scrollicon.png" :class="open ? 'md:mr-3 mr-14' : ''" class="float-right m-3 h-6 cursor-pointer" @click="toggle()" />
                <div x-show="open" class="mx-10 overflow-scroll no-scrollbar h-screen">
                    <a href="/item" class="mx-auto mt-10 border border-slate-500 shrink-0 bg-slate-200 rounded text-center font-black w-7 h-7 flex flex-col justify-center shadow-lg active:shadow active:scale-95 text-slate-500 hover:bg-slate-300 active:bg-slate-400 cursor-pointer" title="New Library Item">+</a>
                    <div class="flex justify-between items-end"><a href="/item/quests/index"><h1 class="text-lg underline font-bold decoration-4">Quests</h1></a> <p class="text-xs text-gray-500">Shift+scroll to scroll horizontally with a mouse wheel</p></div>
                        <livewire:slider :categories="$quests" :catName="'quests'" />
                    <a href="/item/npcs/index"><h1 class="text-lg underline font-bold decoration-4">NPCs</h1></a>
                        <livewire:slider :categories="$npcs" :catName="'npcs'" />
                    <a href="/item/locations/index"><h1 class="text-lg underline font-bold decoration-4">Locations</h1></a>
                        <livewire:slider :categories="$locations" :catName="'locations'" />
                    <a href="/item/organizations/index"><h1 class="text-lg underline font-bold decoration-4">Organizations</h1></a>
                        <livewire:slider :categories="$organizations" :catName="'organizations'" />
                </div>
            </div>
            {{-- Main Body --}}
            <x-panel class="h-screen lg:w-3/4 overflow-y-auto overflow-hidden flex-col">
                {{-- Notes --}}
                <livewire:new-note />
                @if ($notes->isNotEmpty())
                    @foreach ($notes as $note)
                        <hr id="note{{ $note->id }}" />
                        <div x-data="{ open: false, toggle() { this.open =! this.open } }" class="lg:mx-10 2xl:mx-32 md:mx-32 mx-10 my-20 transition-all" x-on:mouseleave="open = false">
                            <div class="flex items-center space-x-2">
                                <h2 class="font-bold focus:outline-0" id="notetitle{{ $note->id }}" contenteditable="true">{{ $note->title }}</h2>
                                <div class="grow"></div>
                                <p class="text-sm italic text-gray-400" title="{{ $note->created_at->tz(auth()->user()->timezone)->toDayDateTimeString() }}">created {{ $note->created_at->tz(auth()->user()->timezone)->diffForHumans() }}</p>
                                <form method="POST" id="{{ 'delete' . $note->id }}" action="/note/{{ $note->id }}/delete">
                                    @csrf
                                    @method('DELETE')
                                    <label hidden for="delete">Delete Note</label>
                                    <input type="image" name="delete" src="images/trash.png" alt="Delete" height="15px" width="15px" class="opacity-50 hover:opacity-100" title="Delete Note" />
                                </form>
                            </div>
                            <div class="flex items-center text-xs">
                                <p class="uppercase">Notebook:</p>
                                <select name='notebook_id' id="notebook{{ $note->id }}" class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                                    <option label="Which notebook?" />
                                    @foreach ($notebooks as $notebook)
                                        <option name="{{ $notebook->name }}" label="{{ $notebook->name }}" value="{{ $notebook->id }}"
                                            @if (isset($note->notebook->id) && $notebook->id === $note->notebook->id)
                                                selected
                                            @endif />
                                    @endforeach
                                </select>
                            </div>
                            <form action="/notes/{{ $note->id }}/notelette" id="notelette" method="POST" x-data="noteletteForm()" @contextmenu="formData.body = window.getSelection().toString()" @submit.prevent="submitData">
                                @csrf
                                <div class="note" @contextmenu="formData.note_id = {{ $note->id }};$event.preventDefault();open = true">
                                    @foreach ($note->notelettes as $notelette)
                                        @php
                                            $noteletteBodies[] = $notelette->body;
                                            $replacements[] = "</span><span contenteditable='false' class='italic bg-red-100 rounded border border-red-300 cursor-pointer' x-data='{}' x-on:click='Livewire.emit(\"editNotelette\", $notelette)'>$notelette->body</span><span contenteditable='true' class='focus:outline-0'>";
                                        @endphp
                                    @endforeach
                                    @if (isset($noteletteBodies))
                                        <div id="notebody{{ $note->id }}"><span contenteditable='true' class="focus:outline-0">{!! str_replace($noteletteBodies, $replacements, $note->body) !!}</span></div>
                                    @else
                                        <div id="notebody{{ $note->id }}"><span contenteditable='true' class="focus:outline-0">{!! $note->body !!}</span></div>
                                    @endif
                                </div>
                                <p x-text="message" class="text-xs text-red-600"></p>
                                <x-notelette-menu
                                    :quests="$quests" :npcs="$npcs" :locations="$locations" :inventoryItems="$inventoryItems" :organizations="$organizations" />
                            </form>
                            <form action="/notes/{{ $note->id }}/update" id="update{{ $note->id }}" method="POST" x-data="noteForm()" @submit.prevent="submitData">
                                @csrf
                                @method('PATCH')
                                <div class="flex justify-end">
                                    <x-form-button @click="formData.note_id = {{ $note->id }}" class="text-sm" title="Save changes to your note. You can only update notelettes by clicking on them first.">Save</x-form-button>
                                </div>
                            </form>
                            <details>
                                <summary>
                                    <p class="text-xs uppercase inline font-bold">Notelettes:</p>
                                    <hr/>
                                </summary>
                                @if ($note->notelettes->first() !== null)
                                    @foreach ($note->notelettes as $notelette)
                                        <x-notelette :notelette="$notelette" />
                                    @endforeach
                                @else
                                    <p class="mb-6">No notelettes yet!</p>
                                @endif
                            </details>
                        </div>
                    @endforeach
                @else
                    <img src="/images/firsttime.png" />
                @endif
            </x-panel>
            {{-- Inventory Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open }}"
                :class="open ? 'lg:min-w-[25%] lg:max-w-[25%] md:w-min w-full h-screen ml-8' : 'ml-2 h-fit'"
                class="absolute lg:static right-0 bg-gradient-to-br from-white via-white to-gray-100 border border-gray-300 no-scrollbar rounded-l shadow-lg bg-white overflow-y-auto overflow-hidden border-r-0 z-10 transition-all"
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
        <div id="hero-logo">
            <img src="images/hero-logo.png"/>
        </div>
        <div id="wizard"><img src="images/wizard.jpg"/></div>
        <div id="space"></div>
        <h2>Note-taking app for the meticulous tabletop player</h2>
        <p id="explain">When playing a tabletop RPG like Dungeons and Dragons, Pathfinder, Call of Cthulhu or the myrad of other games out there, a player can end up taking a lot of notes. And sometimes you have to flip back dozens of pages to find context for the notes you just took. Catharicosa Notes is here to elimitate that painful experience altogether.</p>
        <div id="explain-p">
            <p>Write notes as usual and then highlight details to mark them as "notelettes"</p>
            <p>Attach notelettes to NPCs, Locations, or Quests</p>
            <p>Easily access notelettes later when looking for details about specific NPCs, Locations, or Quests</p>
        </div>
        <div id="space"></div>
        <div id="footer">
            <div id="text">
                <img src="/images/asterisk.png"/>
                <p>A product of <a href="https://thegreenasterisk.com" >The Green Asterisk</a></p>
                <a href="/help">About</a>
            </div>
        </div>
    @endauth
</x-layout>
