<div>
    <x-panel class="md:w-1/4 w-full md:min-w-min mt-20 text-center p-4">
        {{ $pageHeading }}
        <form wire:submit.prevent="submit">
            <div class="flex items-center">
                <input type="text" wire:model="heading" class="grow outline-gray-200 shadow-inner rounded my-2" placeholder="Name and/or Title">
                @if (isset($itemId))
                    <input type="image" src="/images/trash.png" wire:click.prevent="deleteItem" height="15px" width="15px" class="opacity-50 hover:opacity-100 inline" title="Delete Item" />
                @endif
            </div>
            @error('heading') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <textarea type="textarea" wire:model="description" class="w-full h-40 outline-gray-200 shadow-inner rounded my-2" placeholder="Description"></textarea>
            @error('description') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <div class="flex">
                <div class="grow"></div>
                <div class="flex-col">
                    <select wire:model='category' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                        <option label="Choose a category" />
                        <option name="quest" label="Quest" value="quest" />
                        <option name="npc" label="NPC" value="npc" />
                        <option name="location" label="Location" value="location" />
                        <option name="inventory-item" label="Inventory Item" value="inventory-item" />
                    </select>
                    @error('category') <span class="error block text-xs text-red-600">{{ $message }}</span> @enderror
                    @if ($category === "quest")
                        <select wire:model='npc' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                            <option label="Did someone send you on this quest?" />
                            @foreach ($npcs as $npc)
                                <option name="{{ $npc->name }}" label="{{ $npc->name }}" value="{{ $npc->id }}" />
                            @endforeach
                        </select>
                    @endif
                    @if ($category === "quest")
                        <select wire:model='location' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                            <option label="Do you need to go somewhere to complete this quest?" />
                            @foreach ($locations as $location)
                                <option name="{{ $location->name }}" label="{{ $location->name }}" value="{{ $location->id }}" />
                            @endforeach
                        </select>
                    @endif
                    @if ($category === "npc")
                        <select wire:model='location' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                            <option label="Do you know where they live?" />
                            @foreach ($locations as $location)
                                <option name="{{ $location->name }}" label="{{ $location->name }}" value="{{ $location->id }}" />
                            @endforeach
                        </select>
                    @endif
                    @if ($category === "inventory-item")
                    <select wire:model='location' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                        <option label="If you don't have this item, where is it?" />
                        @foreach ($locations as $location)
                            <option name="{{ $location->name }}" label="{{ $location->name }}" value="{{ $location->id }}" />
                        @endforeach
                    </select>
                    <select wire:model='quest' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                        <option label="Is this item part of a quest?" />
                        @foreach ($quests as $quest)
                            <option name="{{ $quest->title }}" label="{{ $quest->title }}" value="{{ $quest->id }}" />
                        @endforeach
                    </select>
                    <select wire:model='npc' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2 w-full md:w-auto">
                        <option label="Does anyone own this item? (Be honest!)" />
                        @foreach ($npcs as $npc)
                            <option name="{{ $npc->name }}" label="{{ $npc->name }}" value="{{ $npc->id }}" />
                        @endforeach
                    </select>
                    @endif
                </div>
            </div>

            <hr />

            <x-form-button>Enter</x-form-button>
            <x-secondary-button href="/">Nevermind</x-secondary-button>
        </form>
    </x-panel>
</div>
