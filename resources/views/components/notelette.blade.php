@props(['notelette'])
<div class="flex items-end flex-wrap">
    <span class="italic bg-red-100 rounded border border-red-300 m-1">{{ $notelette->body }}</span>
    <span class="text-xs italic">Associated with:</span>
    @foreach ($notelette->note as $note)
        <span class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1">
            {{ $note->title }}
        </span>
    @endforeach
    @foreach ($notelette->location as $location)
        <span class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1">
            {{ $location->name }}
        </span>
    @endforeach
    @foreach ($notelette->npc as $npc)
        <span class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1">
            {{ $npc->name }}
        </span>
    @endforeach
    @foreach ($notelette->quest as $quest)
        <span class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1">
            {{ $quest->title }}
        </span>
    @endforeach
    @foreach ($notelette->item as $item)
        <span class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1">
            {{ $item->name }}
        </span>
    @endforeach
    <p class="inline-block grow" />
    <form method="POST" id="{{ 'delete' . $notelette->id }}" action="/notelette/{{ $notelette->id }}/delete">
        @csrf
        @method('DELETE')
        <input type="image" src="images/trash.png" alt="Delete" height="15px" width="15px" class="opacity-50 hover:opacity-100" title="Delete Notelette" />
    </form>
</div>
