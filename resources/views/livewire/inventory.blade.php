<div class="m-10">
    <details class="mb-4 flex text-center">
        <summary class=""><div class="text-lg inline underline font-bold decoration-4 my-4">Inventory</div></summary>
        <div class="flex justify-center" x-data="{ toggle: @entangle('toggle') }">
            <img src="images/ddb-icon.png" class="inline h-6" title="D&D Beyond inventory" />
            <div class="relative w-12 h-6 transition duration-200 ease-linear rounded-full"
                :class="[toggle == 1 ? 'bg-red-600' : 'bg-gray-700']">
            <label for="toggle" class="absolute left-0 w-6 h-6 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                :class="[toggle == 1 ? 'translate-x-full border-red-600' : 'translate-x-0 border-gray-700']"></label>
            <input type="checkbox" id="toggle" name="toggle" wire:model="toggle" class="w-full h-full appearance-none focus:outline-none"
                @click="toggle == 0 ? toggle = 1 : toggle = 0" wire:click="prev()" />
            </div>
            <img src="images/catharicosa-logo.png" class="inline h-6" title="Catharicosa (local) inventory" />
        </div>
    </details>

    @if ($toggle == 0)
        <span class="text-sm">Copy the number from your <a href="https://www.dndbeyond.com" target="_blank"><img src="images/ddb.jpg" class="inline h-4" /></a> character sheet's URL.</span>
        <div class="flex border border-gray-200 rounded-full shadow-inner" x-init="$wire.getInv()">
            <input style="margin-right: -4px" class="border-none indent-2 outline-none focus:outline-none bg-transparent grow text-sm rounded-l-full" wire:model="sheetNumber" wire:input="getInv()" type="text" placeholder="Paste number here" />
            @if ($sheetNumber != auth()->user()->ddb)
                <x-anchor-button href="#" class="text-sm m-1" wire:click="save()">Save</x-anchor-button>
            @endif
            @if ($savedDDB)
                <x-secondary-button href="#" class="text-sm m-1" wire:click="delete()">Delete</x-anchor-button>
            @endif
        </div>
        <p class="text-sm text-red-800">{{ $error }}</p>
        @if ($showInv)
            <div class="flex items-center">
                <h1 class="text-lg underline font-bold decoration-4 grow">{{ $name ? $name . "'s inventory:" : "" }}</h1>
                <x-anchor-button href="#" wire:click="import()" class="text-sm">Import</x-anchor-button>
            </div>
                <p class="text-sm mb-4">{!! $name ? "Manage " . $name . "'s inventory on <a class='hover:text-blue-800 hover:underline' target='_blank' href='https://www.dndbeyond.com/my-characters'>D&D Beyond.com</a>" : "" !!}</p>
            <div class="flex flex-col space-y-4">
                @foreach ($inv as $item)
                    <div class="mb-4 inv bg-gradient-to-br from-white via-white to-gray-100">
                        @if (isset($item->definition->name))
                        <div class="rounded-t border border-slate-500 bg-slate-200 border-b-none font-bold p-1">
                            {{ $item->definition->name }}</p>
                        </div>
                        <div class="rounded-b border border-slate-500 border-t-none p-2">
                            <p class="text-xs uppercase font-bold">Description:</p>
                            {!! $item->definition->description !!}
                        </div>
                        @else
                            @break
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    @elseif ($toggle == 1)
        <div class="flex flex-col lg:min-w-0 md:min-w-[300px] space-y-4">
            @foreach ($inventoryItems as $item)
            <div x-data="{}" x-on:click="$wire.emit('showModal', '{{ $catName }}', {{ $item->id }})" class="cursor-pointer bg-gradient-to-br from-white via-white to-gray-100">
                @if (request()->getQueryString() != null)
                    <div x-init="$wire.emit('showModal', '{{ $catName }}', {{ $item->id }})"></div>
                @endif
                <div class="shadow">
                    <div class="rounded-t border border-slate-500 bg-slate-200 border-b-none font-bold p-1 flex flex-row">
                        <div class="grow">{{ $item->name }}</div>
                    </div>
                    <div class="rounded-b border border-slate-500 border-t-none p-2">
                        <p class="text-xs uppercase font-bold">Description:</p>
                        {!! $item->description !!}
                    </div>
                </div>
            </div>
            @endforeach
            <a href="{{ $query }}" class="rounded border border-slate-500 bg-slate-200 font-bold p-1 flex flex-row flex flex-col justify-center shadow text-slate-500 hover:bg-slate-300 active:bg-slate-400 cursor-pointer text-center text-9xl font-black">+</a>
        </div>
    @endif
</div>
