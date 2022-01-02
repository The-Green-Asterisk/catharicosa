<div>
    <div class="mb-10 overflow-y-scroll flex flex-row gap-x-2 shadow-inner">
        @foreach ($categories as $category)
            <livewire:category.box :category="$category" :catName="$catName" />
        @endforeach
        <div class="h-48 w-48 shrink-0 bg-slate-200 rounded text-center text-9xl font-black flex flex-col justify-center shadow text-slate-500 hover:bg-slate-300 active:bg-slate-400 cursor-pointer">+</div>
    </div>
</div>
