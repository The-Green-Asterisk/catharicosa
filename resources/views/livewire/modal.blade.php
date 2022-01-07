<div>
    @if ($show)
    <x-dialog class="w-1/3 px-10 text-left overflow-y-auto overflow-hidden" @click.away="$wire.emit('closeModal')">
        <div @click="$wire.emit('closeModal')" class="float-right bg-gray-200 rounded-full cursor-default px-2 shadow-lg hover:bg-gray-300 active:bg-gray-500 active:shadow active:scale-95">X</div>
        <span class="text-lg font-bold leading-10">{{ $category->title ?? $category->name }}</span>
        <input type="image" src="images/trash.png" wire:click="deleteItem('{{ $category->id }}')" height="15px" width="15px" class="opacity-50 hover:opacity-100 inline" title="Delete Item" />
        <p class="text-xs uppercase font-bold">Description:</p>
        <div class="mb-6">{!! $category->description !!}</div>
        @if (isset($category->location->name))
            <p class="text-xs uppercase font-bold">Location:</p>
            <p class="mb-6">{{ $category->location->name }}</p>
        @endif
        @if ($catName == 'inventory-items' and isset($category->npc))
            <span class="text-xs italic text-red-800">This item is not yours. {{ $category->npc->name }} owns it.</span>
        @endif
        @if ($catName == 'inventory-items' and isset($category->quest))
            <span class="text-xs italic text-red-800">This item is a part of the "{{ $category->quest->title }}" quest.</span>
        @endif
        <p class="text-xs uppercase font-bold">Notelettes:</p>
        <hr/>
        @if ($category->notelettes->first() !== null)
            @foreach ($category->notelettes as $notelette)
                <x-notelette :notelette="$notelette" />
            @endforeach
        @else
            <p class="mb-6">No notelettes yet!</p>
        @endif
    </x-dialog>
    @endif
</div>
