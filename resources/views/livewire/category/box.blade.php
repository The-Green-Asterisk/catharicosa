<div x-data="{open: false}" @click="open = true" class="cursor-pointer">
    <div class="w-48 h-48 grow border rounded border-gray-500 shadow flex flex-col flex-none">
        <div class="bg-slate-200 flex overflow-x-auto p-2">
            <p class="flex-shrink-0 text-sm font-bold uppercase underline">{{ $category->title ?? $category->name }}</p>
        </div>
        <div class="overflow-y-auto overflow-hidden p-2">
            <p class="text-xs uppercase font-bold">Description:</p>
            <p class="text-sm">{{ $category->description }}</p>
        </div>
    </div>
    <x-dialog class="w-1/3 px-10 text-left overflow-y-auto overflow-hidden">
        <p class="text-lg font-bold mb-6">{{ $category->title ?? $category->name }}</p>
        <p class="text-xs uppercase font-bold">Description:</p>
        <p class="mb-6">{{ $category->description }}</p>
        <p class="text-xs uppercase font-bold">Notelettes:</p>
        <hr/>
        @foreach ($category->notelettes as $notelette)
            <x-notelette :notelette="$notelette" />
        @endforeach
    </x-dialog>
</div>
