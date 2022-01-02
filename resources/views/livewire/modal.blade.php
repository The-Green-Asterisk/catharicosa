<div>
    @if ($show)
    <x-dialog class="w-1/3 px-10 text-left overflow-y-auto overflow-hidden" @click.away="$wire.emit('closeModal')">
        <p class="text-lg font-bold mb-6">{{ $category->title ?? $category->name }}</p>
        <p class="text-xs uppercase font-bold">Description:</p>
        <p class="mb-6">{{ $category->description }}</p>
        <p class="text-xs uppercase font-bold">Notelettes:</p>
        <hr/>
        @foreach ($category->notelettes as $notelette)
            <x-notelette :notelette="$notelette" />
        @endforeach
    </x-dialog>
    @endif
</div>
