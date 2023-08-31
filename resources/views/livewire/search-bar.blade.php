<div class="flex justify-center md:mt-14 order-last md:order-none w-screen md:w-auto h-16 md:h-auto">
    @auth
        <div class="absolute flex flex-col border border-gray-200 rounded-xl bg-white w-screen md:w-1/3 m-auto shadow-lg z-30" >
            <input type="text" style="font-size:20px;" class="placeholder:text-xl placeholder:italic border-none indent-2 outline-none focus:outline-none bg-transparent min-w-0 grow text-sm rounded-full" wire:model="term" placeholder="Search through your adventure..." x-data="{}" @click.away="$wire.clear()"/>
            <div class="max-h-[60vh] overflow-auto">
                @if ($noteOutput !== null && $noteOutput->isNotEmpty())
                    <p class="text-lg font-bold text-red-500 mt-6 px-4">Notes</p>
                    <hr />
                    @foreach ($noteOutput as $note)
                        <a href="#note{{ $note->id }}">
                            <p class="px-4 font-semibold hover:underline hover:text-blue-400">
                                {!! $note->title !!}
                            </p>
                        </a>
                        <p class="text-xs italic px-4 mb-2">{!! $note->body !!}...</p>
                    @endforeach
                @endif
                @if ($noteletteOutput !== null && $noteletteOutput->isNotEmpty())
                    <p class="text-lg font-bold text-red-500 mt-6 px-4">Notelettes</p>
                    <hr />
                    @foreach ($noteletteOutput as $notelette)
                        <div class="px-4 mb-2">
                            <x-notelette :notelette="$notelette" />
                        </div>
                    @endforeach
                @endif
                @if ($questOutput !== null && $questOutput->isNotEmpty())
                    <p class="text-lg font-bold text-slate-500 mt-6 px-4">Quests</p>
                    <hr />
                    @foreach ($questOutput as $quest)
                        <div x-data="{}" x-on:click="$wire.emit('showModal', 'quests', {{ $quest->id }})" class="hover:cursor-pointer">
                            <p class="px-4 font-semibold hover:underline hover:text-blue-400">
                                {!! $quest->title !!}
                            </p>
                            <p class="text-xs italic px-4 mb-2">{!! $quest->description !!}...</p>
                        </div>
                    @endforeach
                @endif
                @if ($npcOutput !== null && $npcOutput->isNotEmpty())
                    <p class="text-lg font-bold text-slate-500 mt-6 px-4">NPCs</p>
                    <hr />
                    @foreach ($npcOutput as $npc)
                        <div x-data="{}" x-on:click="$wire.emit('showModal', 'npcs', {{ $npc->id }})" class="hover:cursor-pointer">
                            <p class="px-4 font-semibold hover:underline hover:text-blue-400">
                                {!! $npc->name !!}
                            </p>
                            <p class="text-xs italic px-4 mb-2">{!!  $npc->description !!}...</p>
                        </div>
                    @endforeach
                @endif
                @if ($locationOutput !== null && $locationOutput->isNotEmpty())
                    <p class="text-lg font-bold text-slate-500 mt-6 px-4">Locations</p>
                    <hr />
                    @foreach ($locationOutput as $location)
                        <div x-data="{}" x-on:click="$wire.emit('showModal', 'locations', {{ $location->id }})" class="hover:cursor-pointer">
                            <p class="px-4 font-semibold hover:underline hover:text-blue-400">
                                {!! $location->name !!}
                            </p>
                            <p class="text-xs italic px-4 mb-2">{!! $location->description !!}...</p>
                        </div>
                    @endforeach
                @endif
                @if ($invItemOutput !== null && $invItemOutput->isNotEmpty())
                    <p class="text-lg font-bold text-slate-500 mt-6 px-4">Inventory Items</p>
                    <hr />
                    @foreach ($invItemOutput as $item)
                        <div x-data="{}" x-on:click="$wire.emit('showModal', 'inventory-items', {{ $item->id }})" class="hover:cursor-pointer">
                            <p class="px-4 font-semibold hover:underline hover:text-blue-400">
                                {!! $item->name !!}
                            </p>
                            <p class="text-xs italic px-4 mb-2">{!! $item->description !!}...</p>
                        </div>
                    @endforeach
                @endif
                @if ($organizationOutput !== null && $organizationOutput->isNotEmpty())
                    <p class="text-lg font-bold text-slate-500 mt-6 px-4">Organizations</p>
                    <hr />
                    @foreach ($organizationOutput as $organization)
                        <div x-data="{}" x-on:click="$wire.emit('showModal', 'organizations', {{ $organization->id }})" class="hover:cursor-pointer">
                            <p class="px-4 font-semibold hover:underline hover:text-blue-400">
                                {!! $organization->name !!}
                            </p>
                            <p class="text-xs italic px-4 mb-2">{!! $organization->description !!}...</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endauth
</div>
