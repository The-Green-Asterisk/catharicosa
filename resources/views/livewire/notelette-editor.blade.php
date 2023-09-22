<div>
    @if ($showNoteletteEditor)
    <x-dialog class="w-screen md:w-1/3 px-10 text-left overflow-y-auto overflow-hidden" @click.away="$wire.emit('closeNotelette')">
        <div @click="$wire.emit('closeNotelette')" class="float-right bg-gray-200 rounded-full cursor-default px-2 shadow-lg hover:bg-gray-300 active:bg-gray-500 active:shadow active:scale-95">X</div>
        <div class="flex items-center">
            <input type="text" wire:model="body" class="bg-red-100 border border-red-300 outline-red-200 grow shadow-inner rounded indent-2" />
            <input type="image" src="images/trash.png" wire:click="deleteNotelette()" height="15px" width="15px" class="opacity-50 hover:opacity-100 inline" title="Delete Notelette" />
        </div>
        <div><p class="w-full text-center font-bold">Associations</p>
            <div class="flex flex-wrap">
                <div class="w-1/3 mb-5"><p class="font-semibold">Quests</p>
                    @foreach ($quests as $key => $questArray)
                        <input type="checkbox" wire:key="{{ $key }}" wire:model="questArray" value="{{ $questArray->id }}">{{ $questArray->title }}<br />
                    @endforeach
                </div>
                <div class="w-1/3 mb-5"><p class="font-semibold">Locations</p>
                    @foreach ($locations as $key => $locationArray)
                        <input type="checkbox" wire:key="{{ $key }}" wire:model="locationArray" value="{{ $locationArray->id }}">{{ $locationArray->name }}<br />
                    @endforeach
                </div>
                <div class="w-1/3 mb-5"><p class="font-semibold">NPCs</p>
                    @foreach ($npcs as $key => $npcArray)
                        <input type="checkbox" wire:key="{{ $key }}" wire:model="npcArray" value="{{ $npcArray->id }}">{{ $npcArray->name }}<br />
                    @endforeach
                </div>
                <div class="w-1/2"><p class="font-semibold">Inventory Items</p>
                    @foreach ($inventoryItems as $key => $itemArray)
                        <input type="checkbox" wire:key="{{ $key }}" wire:model="itemArray" value="{{ $itemArray->id }}">{{ $itemArray->name }}<br />
                    @endforeach
                </div>
                <div class="w-1/2"><p class="font-semibold">Organizations</p>
                    @foreach ($organizations as $key => $itemArray)
                        <input type="checkbox" wire:key="{{ $key }}" wire:model="itemArray" value="{{ $itemArray->id }}">{{ $itemArray->name }}<br />
                    @endforeach
                </div>
            </div>
            <x-anchor-button href="#" wire:click="save">Save</x-anchor-button>
        </div>
    </x-dialog>
    @endif
</div>
