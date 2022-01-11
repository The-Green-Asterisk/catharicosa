<div class="flex flex-row gap-2 flex-wrap m-2 justify-center">
    <h1 class="text-xl leading-10 underline font-bold decoration-4 w-screen text-center">
        @if ($catName === 'quests')
            Quests
        @endif
        @if ($catName === 'npcs')
            NPCs
        @endif
        @if ($catName === 'locations')
            Locations
        @endif
        @if ($catName === 'inventory-items')
            Inventory Items
        @endif
    </h1>
    @foreach ($categories as $category)
    <livewire:category.box :category="$category" :catName="$catName" />
    @endforeach
    <a href="{{ $query }}" class="border border-slate-500 h-48 w-48 shrink-0 bg-slate-200 rounded text-center text-9xl font-black flex flex-col justify-center shadow text-slate-500 hover:bg-slate-300 active:bg-slate-400 cursor-pointer">+</a>
</div>
