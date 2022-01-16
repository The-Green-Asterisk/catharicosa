<div x-data="{}" x-on:click="$wire.emit('showModal', '{{ $catName }}', {{ $category->id }})" class="cursor-pointer bg-gradient-to-br from-white via-white to-gray-100">
    @if (preg_match('/(catName)|(cid)/', request()->getQueryString()))
        <div x-init="$wire.emit('showModal', '{{ $catName }}', {{ $category->id }})"></div>
    @endif
    <div class="shadow flex flex-col flex-none">
        <div class="rounded-t border border-slate-500 bg-slate-200 border-b-none font-bold p-1 h-8 w-48 flex overflow-x-auto overflow-y-hidden">
            <div class="flex-shrink-0">{{ $category->title ?? $category->name }}</div>
        </div>
        <div class="rounded-b border border-slate-500 border-t-none p-2 h-40 w-48 overflow-y-auto">
            <p class="text-xs uppercase font-bold">Description:</p>
            {!! $category->description !!}
        </div>
    </div>
</div>
