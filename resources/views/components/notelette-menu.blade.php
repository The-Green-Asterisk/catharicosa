@props(['quests', 'npcs', 'locations', 'inventoryItems', 'organizations'])
<div class="fixed inset-0 overflow-scroll z-40 no-scrollbar"
        x-show="open"
        x-transition>
    <div class="menu z-50 absolute bg-white block shadow-lg p-2 w-56 border border-gray-400"
        @click.away="open = false">
        <ul class="menu-options">
            <lh @click="submitDataWithItem('quest')" x-data="{open: false}" @mouseenter="open = true" @mouseleave="open = false" class="text-sm hover:bg-slate-200 uppercase font-bold block cursor-default flex items-center">
                <div>Quest</div>
                <div class="grow"></div>
                <div class="text-xs italic font-light lowercase px-2" x-show="open">+add new</div>
                </lh><hr />
            @foreach ($quests as $quest)
                <li class="menu-option hover:bg-slate-200 cursor-default"
                    @click="formData.quest_id = {{ $quest->id }}; submitData()">{{ $quest->title }}</li>
            @endforeach
            <br />
            <lh @click="submitDataWithItem('npc')" x-data="{open: false}" @mouseenter="open = true" @mouseleave="open = false" class="text-sm hover:bg-slate-200 uppercase font-bold block cursor-default flex items-center">
                <div>NPC</div>
                <div class="grow"></div>
                <div class="text-xs italic font-light lowercase px-2" x-show="open">+add new</div>
                </lh><hr />
            @foreach ($npcs as $npc)
                <li class="menu-option hover:bg-slate-200 cursor-default"
                    @click="formData.npc_id = {{ $npc->id }}; submitData()">{{ $npc->name }}</li>
            @endforeach
            <br />
            <lh @click="submitDataWithItem('location')" x-data="{open: false}" @mouseenter="open = true" @mouseleave="open = false" class="text-sm hover:bg-slate-200 uppercase font-bold block cursor-default flex items-center">
                <div>Location</div>
                <div class="grow"></div>
                <div class="text-xs italic font-light lowercase px-2" x-show="open">+add new</div>
                </lh><hr />
            @foreach ($locations as $location)
                <li class="menu-option hover:bg-slate-200 cursor-default"
                    @click="formData.location_id = {{ $location->id }}; submitData()">{{ $location->name }}</li>
            @endforeach
            <br />
            <lh @click="submitDataWithItem('inventory-item')" x-data="{open: false}" @mouseenter="open = true" @mouseleave="open = false" class="text-sm hover:bg-slate-200 uppercase font-bold block cursor-default flex items-center">
                <div>Inventory Item</div>
                <div class="grow"></div>
                <div class="text-xs italic font-light lowercase px-2" x-show="open">+add new</div>
                </lh><hr />
            @foreach ($inventoryItems as $item)
                <li class="menu-option hover:bg-slate-200 cursor-default"
                    @click="formData.inventory_item_id = {{ $item->id }}; submitData()">{{ $item->name }}</li>
            @endforeach
            <br />
            <lh @click="submitDataWithItem('organization')" x-data="{open: false}" @mouseenter="open = true" @mouseleave="open = false" class="text-sm hover:bg-slate-200 uppercase font-bold block cursor-default flex items-center">
                <div>Organization</div>
                <div class="grow"></div>
                <div class="text-xs italic font-light lowercase px-2" x-show="open">+add new</div>
                </lh><hr />
            @foreach ($organizations as $organization)
                <li class="menu-option hover:bg-slate-200 cursor-default"
                    @click="formData.organization_id = {{ $organization->id }}; submitData()">{{ $organization->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
