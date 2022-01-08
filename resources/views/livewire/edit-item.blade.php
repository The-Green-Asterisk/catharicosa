<div>
    <x-panel class="w-1/4 min-w-min mt-20 text-center p-4">
        Which part of your story would you like to change?
        <form wire:submit.prevent="update">
            <input type="text" wire:model="heading" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="Name and/or Title">
            @error('heading') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <textarea type="textarea" wire:model="description" class="w-full h-40 outline-gray-200 shadow-inner rounded my-2" placeholder="Description"></textarea>
            @error('description') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <div class="flex">
                <div class="grow"></div>
                <div class="flex-col">
                    <select wire:model='category' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                        <option label="Choose a category" />
                        <option name="quest" label="Quest" value="quest" />
                        <option name="npc" label="NPC" value="npc" />
                        <option name="location" label="Location" value="location" />
                        <option name="inventory-item" label="Inventory Item" value="inventory-item" />
                    </select>
                @error('category') <span class="error block text-xs text-red-600">{{ $message }}</span> @enderror
                    @if ($category === "npc")
                        <select wire:model='location' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                            <option label="Where do they live?" />
                            @foreach ($locations as $location)
                                <option name="{{ $location->name }}" label="{{ $location->name }}" value="{{ $location->id }}" />
                            @endforeach
                            <option name="idk" label="I don't know" value="idk" />
                        </select>
                    @endif
                    @if ($category === "quest")
                        <select wire:model='npc' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                            <option label="Who sent you on this quest?" />
                            @foreach ($npcs as $npc)
                                <option name="{{ $npc->name }}" label="{{ $npc->name }}" value="{{ $npc->id }}" />
                            @endforeach
                            <option name="idk" label="I don't know" />
                            <option name="noone" label="No one" />
                        </select>
                        <select wire:model='location' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                            <option label="Where do you need to go to complete this quest?" />
                            @foreach ($locations as $location)
                                <option name="{{ $location->name }}" label="{{ $location->name }}" value="{{ $location->id }}" />
                            @endforeach
                            <option name="idk" label="I don't know" />
                            <option name="nowhere" label="Nowhere in particular" />
                        </select>
                    @endif
                    @if ($category === "inventory-item")
                    <select wire:model='location' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                        <option label="Where is this item?" />
                        @foreach ($locations as $location)
                            <option name="{{ $location->name }}" label="{{ $location->name }}" value="{{ $location->id }}" />
                        @endforeach
                        <option name="me" label="I have it" value="0" />
                        <option name="idk" label="I don't know" />
                    </select>
                    <select wire:model='quest' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                        <option label="Is this item part of a quest?" />
                        @foreach ($quests as $quest)
                            <option name="{{ $quest->title }}" label="{{ $quest->title }}" value="{{ $quest->id }}" />
                        @endforeach
                        <option name="idk" label="I don't know" />
                        <option name="no" label="No" />
                    </select>
                    <select wire:model='npc' class="outline-gray-200 bg-white px-2 shadow-inner rounded my-2">
                        <option label="Who owns this item?" />
                        @foreach ($npcs as $npc)
                            <option name="{{ $npc->name }}" label="{{ $npc->name }}" value="{{ $npc->id }}" />
                        @endforeach
                        <option name="me" label="Me" value="0" />
                        <option name="noone" label="No one" />
                        <option name="idk" label="I don't know" />
                    </select>
                    @endif
                </div>
            </div>

            <hr />

            <x-form-button>Update</x-form-button>
            <x-secondary-button href="/">Nevermind</x-secondary-button>
        </form>
    </x-panel>
</div>
