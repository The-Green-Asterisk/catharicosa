<div class="m-10">
    <style>
        .inv p {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
    </style>
    <div class="flex justify-center" x-data="{ toggle: @entangle('toggle') }">
        <img src="images/ddb-icon.png" class="inline h-6" title="D&D Beyond inventory" />
        <div class="relative w-12 h-6 transition duration-200 ease-linear rounded-full"
            :class="[toggle == 1 ? 'bg-red-600' : 'bg-gray-700']">
        <label for="toggle" class="absolute left-0 w-6 h-6 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
            :class="[toggle == 1 ? 'translate-x-full border-red-600' : 'translate-x-0 border-gray-700']"></label>
        <input type="checkbox" id="toggle" name="toggle" wire:model="toggle" class="w-full h-full appearance-none focus:outline-none"
            @click="toggle == 0 ? toggle = 1 : toggle = 0" />
        </div>
        <img src="images/catharicosa-logo.png" class="inline h-6" title="Catharicosa (local) inventory" />
    </div>
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
            <h1 class="text-lg underline font-bold decoration-4">{{ $name ? $name . "'s inventory:" : "" }}</h1>
            <p class="text-sm mb-4">{!! $name ? "Manage " . $name . "'s inventory on <a class='hover:text-blue-800 hover:underline' target='_blank' href='https://www.dndbeyond.com/my-characters'>D&D Beyond.com</a>" : "" !!}</p>
            @foreach ($inv as $item)
                <div class="mb-4 inv">
                    @if (isset($item->definition->name))
                        <p class="font-bold">{{ $item->definition->name }}</p>
                        {!! $item->definition->description !!}
                    @else
                        @break
                    @endif
                </div>
            @endforeach
        @endif
    @elseif ($toggle == 1)
    Nothing to see here. Move along.
    @endif
</div>
