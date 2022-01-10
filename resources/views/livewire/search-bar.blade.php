<div class="relative flex justify-center h-16">
    @auth
        <div class="absolute flex flex-col border border-gray-200 rounded-xl shadow-inner bg-white w-screen md:w-1/3 m-auto shadow-xl z-30" >
            <input type="text" style="font-size:20px;" class="placeholder:text-xl border-none indent-2 outline-none focus:outline-none bg-transparent min-w-0 grow text-sm rounded-full" wire:model="term" placeholder="Search through your adventure..." x-data="{}" @click.away="$wire.clear()"/>
            @if ($questOutput->isNotEmpty())
                <p class="text-lg font-bold text-slate-400 mt-6 px-4">Quests</p>
                <hr />
                @foreach ($questOutput as $quest)
                    <p x-data="{}" 
                        x-on:click="$wire.emit('showModal', 'quests', {{ $quest->id }})"
                        class="px-4 hover:underline hover:text-blue-400 hover:cursor-pointer">
                        {{ $quest->title }}
                    </p>
                    <p class="text-xs italic px-4 mb-2">{{ substr(strip_tags($quest->description), 0, 150) }}...</p>
                @endforeach
            @endif
            @if ($npcOutput->isNotEmpty())
                <p class="text-lg font-bold text-slate-400 mt-6 px-4">NPCs</p>
                <hr />
                @foreach ($npcOutput as $npc)
                    <p x-data="{}" 
                        x-on:click="$wire.emit('showModal', 'npcs', {{ $npc->id }})"
                        class="px-4 hover:underline hover:text-blue-400 hover:cursor-pointer">
                        {{ $npc->name }}
                    </p>
                    <p class="text-xs italic px-4 mb-2">{{ substr(strip_tags($npc->description), 0, 150) }}...</p>
                @endforeach
            @endif
            @if ($locationOutput->isNotEmpty())
                <p class="text-lg font-bold text-slate-400 mt-6 px-4">Locations</p>
                <hr />
                @foreach ($locationOutput as $location)
                    <p x-data="{}" 
                        x-on:click="$wire.emit('showModal', 'locations', {{ $location->id }})"
                        class="px-4 hover:underline hover:text-blue-400 hover:cursor-pointer">
                        {{ $location->name }}
                    </p>
                    <p class="text-xs italic px-4 mb-2">{{ substr(strip_tags($location->description), 0, 150) }}...</p>
                @endforeach
            @endif
            @if ($invItemOutput->isNotEmpty())
                <p class="text-lg font-bold text-slate-400 mt-6 px-4">Inventory Items</p>
                <hr />
                @foreach ($invItemOutput as $item)
                    <p x-data="{}" 
                        x-on:click="$wire.emit('showModal', 'inventory-items', {{ $item->id }})"
                        class="px-4 hover:underline hover:text-blue-400 hover:cursor-pointer">
                        {{ $item->name }}
                    </p>
                    <p class="text-xs italic px-4 mb-2">{{ substr(strip_tags($item->description), 0, 150) }}...</p>
                @endforeach
            @endif
        </div>
    @endauth
</div>
