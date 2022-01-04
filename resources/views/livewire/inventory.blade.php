<div class="m-10">
    <style>
        .inv p {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
    </style>
    <span class="text-xs">Copy the number from your D&D Beyond character sheet's URL.</span>
    <div class="flex">
        <input class="border grow text-sm rounded" wire:model="sheetNumber" wire:input="getInv()" type="text" placeholder="Paste number here" />
        <x-anchor-button href="#" class="text-sm" wire:click="save()">Save</x-anchor-button>
    </div>
    @if (isset($inv))
        <h1 class="text-lg underline font-bold decoration-4">{{ $name ? $name . "'s inventory:" : "" }}</h1>
        <p class="text-sm mb-4">{!! $name ? "Manage " . $name . "'s inventory on <a class='hover:text-blue-800 hover:underline' target='_blank' href='https://www.dndbeyond.com/my-characters'>D&D Beyond.com</a>" : "" !!}</p>
        @foreach ($inv as $item)
            <div class="mb-4 inv">
                @if (isset($item->definition->name))
                    <p class="font-bold">{{ $item->definition->name }}</p>
                    {!! $item->definition->description !!}
                @else
                    <p class="text-sm text-red-800">{{ $error }}</p>
                    @break
                @endif
            </div>
        @endforeach
    @endif
</div>
