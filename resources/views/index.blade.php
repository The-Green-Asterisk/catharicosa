<x-layout>
    @auth
        <div class="flex">
            {{-- Category Sidebar --}}
            <div x-data="{ open: true, toggle() { this.open =! this.open } }" :class="open ? 'lg:min-w-[25%] max-w-[25%] h-screen mr-8' : 'h-fit mr-2'" class="transition-all bg-gradient-to-br from-white via-white to-gray-100 border border-gray-500 rounded-r shadow bg-white overflow-y-auto overflow-hidden border-l-0">
                <img src="scrollicon.png" class="float-right m-3 h-6" @click="toggle()" />
                <div x-show="open" class="m-10" x-transition>
                    <h1 class="text-lg underline font-bold decoration-4">Quests</h1>
                        <livewire:slider :categories="$quests" />
                    <h1 class="text-lg underline font-bold decoration-4">NPCs</h1>
                        <livewire:slider :categories="$npcs" />
                    <h1 class="text-lg underline font-bold decoration-4">Locations</h1>
                        <livewire:slider :categories="$locations" />
                </div>
            </div>
            {{-- Main Body --}}
            <x-panel class="h-screen lg:max-w-3/4 overflow-y-auto overflow-hidden flex-col">
                {{-- Notes --}}
                <livewire:new-note />
                @foreach ($notes as $note)
                    <div class="mx-32 my-10 transition-all" id="note">
                        <div class="flex justify-between">
                            <h2 class="font-bold">{{ $note->title }}</h2>
                            <p class="text-sm italic text-gray-400">created {{ $note->created_at->diffForHumans() }}</p>
                        </div>
                        <form action="/notes/{{ $note->id }}/notelette" id="notelette" method="POST" x-data="noteletteForm()" @submit.prevent="submitData">
                            @csrf
                            <div><textarea class="w-full">{{ $note->body }}</textarea></div>
                            <p x-text="message" class="text-xs text-red-600"></p>
                            <div class="menu bg-white shadow p-2 border border-gray-100">
                                <ul class="menu-options">
                                    <lh>Quest</lh>
                                    <hr />
                                    @foreach ($quests as $quest)
                                        <li class="menu-option"
                                            x-data="{
                                                'quest': {{ $quest->id }},
                                                'note': {{ $note->id }},
                                                getNote() { formData.note_id = this.note },
                                                getBody() { formData.body = window.getSelection().toString() },
                                                getQuest() { formData.quest_id = this.quest }
                                            }" @click="getBody(); getNote(); getQuest(); console.log(formData.body); submitData()">{{ $quest->title }}</li>
                                    @endforeach
                                    <lh>NPC</lh>
                                    <hr />
                                    @foreach ($npcs as $npc)
                                        <li class="menu-option"
                                            x-data="{
                                                'npc': {{ $npc->id }},
                                                getNPC() { formData.npc_id = this.npc }
                                            }" @click="getBody(); getNote(); getNPC(); submitData()">{{ $npc->name }}</li>
                                    @endforeach
                                    <lh>Location</lh>
                                    <hr />
                                    @foreach ($locations as $location)
                                        <li class="menu-option"
                                            x-data="{
                                                'location': {{ $location->id }},
                                                getLocation() { formData.location_id = this.location }
                                            }" @click="getBody(); getNote(); getLocation(); submitData()">{{ $location->name }}</li>
                                    @endforeach
                                </ul>
                                <input type="hidden" x-model="formData.body" />
                                <input type="hidden" x-model="formData.note_id" />
                                <input type="hidden" x-model="formData.quest_id" />
                                <input type="hidden" x-model="formData.npc_id" />
                                <input type="hidden" x-model="formData.location_id" />
                            </div>
                        </form>
                        @foreach ($note->notelettes as $notelette)
                            <p class="italic">{{ $notelette->body }}</p>
                        @endforeach
                    </div>
                @endforeach
                <script>
                    const menu = document.querySelector(".menu");
                    const menuOption = document.querySelector(".menu-option");
                    let menuVisible = false;

                    const toggleMenu = command => {
                    menu.style.display = command === "show" ? "block" : "none";
                    menuVisible = !menuVisible;
                    };

                    const setPosition = ({ top, left }) => {
                    menu.style.left = `${left}px`;
                    menu.style.top = `${top}px`;
                    toggleMenu("show");
                    };

                    window.addEventListener("click", e => {
                    if (menuVisible) toggleMenu("hide");
                    });

                    document.addEventListener("select", e => {
                    e.preventDefault();
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
                <img src="backpack.png" :class="open ? 'm-3 h-6 absolute' : 'm-3 h-6'" @click="toggle()" />
                <div x-show="open">
                    <livewire:inventory />
                </div>
            </div>
        </div>
    @else
        <div class="bg-white bg-fixed bg-no-repeat flex justify-center shadow-inner" style="background-image: url('wizard.jpg');padding-left:736px;">
            <img src="hero-logo.png" class="h-96" />
        </div>
        <div class="text-3xl font-bold text-center m-10">Note-taking app for the meticulous tabletop player</div>

        <div class="flex justify-between p-20">
            <div class="w-96 text-xl">Write notes as usual and then highlight details to mark them as "notelettes"</div>
            <div class="w-96 text-xl">Attach notelettes to NPCs, Locations, or Quests</div>
            <div class="w-96 text-xl">Easily access notelettes later when looking for details about specific NPCs, Locations, or Quests</div>
        </div>
    @endauth
</x-layout>
