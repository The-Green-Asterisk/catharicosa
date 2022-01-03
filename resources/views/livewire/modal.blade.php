<div>
    @if ($show)
    <x-dialog class="w-1/3 px-10 text-left overflow-y-auto overflow-hidden" @click.away="$wire.emit('closeModal')">
        <div @click="$wire.emit('closeModal')" class="float-right bg-gray-200 rounded-full cursor-default px-2 shadow-lg hover:bg-gray-300 active:bg-gray-500 active:shadow active:scale-95">X</div>
        <p class="text-lg font-bold mb-6">{{ $category->title ?? $category->name }}</p>
        <p class="text-xs uppercase font-bold">Description:</p>
        <p class="mb-6">{{ $category->description }}</p>
        @if (isset($category->location->name))
            <p class="text-xs uppercase font-bold">Location:</p>
            <p class="mb-6">{{ $category->location->name }}</p>
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
