@props(['quests', 'npcs', 'locations', 'inventoryItems'])
<div class="menu z-20 bg-white absolute block shadow-lg p-2 w-52 border border-gray-400"
    x-show="open"
    x-transition
    @click.away="open = false">
    <ul class="menu-options">
        <lh class="text-sm uppercase font-bold">Quest<hr /></lh>
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
        <br />
        <lh class="text-sm uppercase font-bold">Item<hr /></lh>
        @foreach ($inventoryItems as $item)
            <li class="menu-option hover:bg-gray-200 cursor-default"
                @click="formData.inventory_item_id = {{ $item->id }}; submitData()">{{ $item->name }}</li>
        @endforeach
    </ul>
</div>
