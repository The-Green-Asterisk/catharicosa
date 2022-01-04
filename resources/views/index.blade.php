<x-layout>
    @auth
        <div class="flex">
            {{-- Category Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open } }" :class="open ? 'lg:min-w-[25%] max-w-[25%] h-screen mr-8' : 'h-fit mr-2'" class="transition-all bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-r shadow bg-white overflow-y-auto overflow-hidden border-l-0">
                <img src="images/scrollicon.png" class="float-right m-3 h-6" @click="toggle()" />
                <div x-show="open" class="m-10" x-transition>
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
                    <div x-data="{ open: false, toggle() { this.open =! this.open } }" class="mx-32 my-10 transition-all" x-on:mouseleave="open = false">
                        <div class="flex items-center">
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
                            <div class="menu z-20 bg-white absolute block shadow-lg p-2 w-52 border border-gray-400"
                                x-show="open"
                                x-transition
                                @click.away="open = false">
                                <ul class="menu-options">
                                    <lh class="text-sm uppercase font-bold">Quest {{ $note->id }}<hr /></lh>
                                    @foreach ($quests as $quest)
                                        <li class="menu-option hover:bg-gray-200 cursor-default"
                                            @click="formData.quest_id = {{ $quest->id }}; submitData()">{{ $quest->title }}</li>
                                    @endforeach
                                    <br />
                                    <lh class="text-sm uppercase font-bold">NPC<hr /></lh>
                                    @foreach ($npcs as $npc)
                                        <li class="menu-option hover:bg-gray-200 cursor-default"
                                            @click="formData.npc_id = {{ $npc->id }}; submitData()">{{ $npc->name }}</li>
                                    @endforeach
                                    <br />
                                    <lh class="text-sm uppercase font-bold">Location<hr /></lh>
                                    @foreach ($locations as $location)
                                        <li class="menu-option hover:bg-gray-200 cursor-default"
                                            @click="formData.location_id = {{ $location->id }}; submitData()">{{ $location->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                        @foreach ($note->notelettes as $notelette)
                            <x-notelette :notelette="$notelette" />
                        @endforeach
                    </div>
                @endforeach
                <script>
                    const setPosition = ({ top, left }) => {
                        var menus = document.getElementsByClassName('menu');
                        Array.prototype.forEach.call(menus, function(el){
                            el.style.left = `${left}px`;
                            el.style.top = `${top}px`;
                        });
                    };

                    window.addEventListener("contextmenu", e => {
                        const origin = {
                            left: e.pageX,
                            top: e.pageY
                        };
                        setPosition(origin);

                        return false;
                    });

                    var csrf = document.querySelector('meta[name="csrf-token"]').content;

                    function noteletteForm(note_id, body, quest_id, npc_id, location_id) {
                        return {
                            formData: {
                                body: body,
                                quest_id: quest_id,
                                npc_id: npc_id,
                                location_id: location_id
                            },
                            message: '',

                            submitData() {
                                this.message = ''

                                fetch('/notes/' + this.formData.note_id + '/notelette', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf },
                                    body: JSON.stringify(this.formData)
                                })
                                .then(() => {
                                    this.message = 'Your notelette has been created!',
                                    location.reload()
                                })
                                .catch(() => {
                                    this.message = 'Ooops! Something went wrong!'
                                })
                            }
                        }
                    }
                </script>
            </x-panel>
            {{-- Inventory Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open } }" :class="open ? 'lg:min-w-[25%] max-w-[25%] h-screen ml-8' : 'ml-2 h-fit'" class="bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-l shadow bg-white overflow-y-auto overflow-hidden border-r-0" x-transition>
                <img src="images/backpack.png" :class="open ? 'm-3 h-6 absolute' : 'm-3 h-6'" @click="toggle()" />
                <div x-show="open">
                    <livewire:inventory />
                </div>
            </div>
        </div>
    @else
    {{-- Guest view --}}
        <div class="bg-white bg-fixed bg-no-repeat flex justify-center shadow-inner" style="background-image: url('images/wizard.jpg');padding-left:736px;">
            <img src="images/hero-logo.png" class="h-96" />
        </div>
        <div class="text-3xl font-bold text-center m-10">Note-taking app for the meticulous tabletop player</div>

        <div class="flex justify-evenly">
            <div class="w-96 text-xl">Write notes as usual and then highlight details to mark them as "notelettes"</div>
            <div class="w-96 text-xl">Attach notelettes to NPCs, Locations, or Quests</div>
            <div class="w-96 text-xl">Easily access notelettes later when looking for details about specific NPCs, Locations, or Quests</div>
        </div>
    @endauth
</x-layout>
