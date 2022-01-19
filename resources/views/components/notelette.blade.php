@props(['notelette'])
<div>
    <div class="flex items-end flex-wrap">
        <span class="italic bg-red-100 rounded border border-red-300 m-1 cursor-pointer" x-data="{}" x-on:click="Livewire.emit('editNotelette', {!! $notelette !!})">{{ $notelette->body }}</span>
        <p class="inline-block grow" />
        <form method="POST" id="{{ 'delete' . $notelette->id }}" action="/notelette/{{ $notelette->id }}/delete">
            @csrf
            @method('DELETE')
            <label hidden for="delete">Delete Notelette</label>
            <input type="image" name="delete" src="/images/trash.png" alt="Delete" height="15px" width="15px" class="opacity-50 hover:opacity-100" title="Delete Notelette" />
        </form>
    </div>
    <span class="text-xs italic">Associated with:</span>
    @foreach ($notelette->note as $note)
        <a href="/#note{{ $note->id }}">
            <span class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1">
                {{ $note->title }}
            </span>
        </a>
    @endforeach
    @foreach ($notelette->location as $location)
        <span  x-data="{}" x-on:click="Livewire.emit('showModal', 'locations', {{ $location->id }})" class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1 cursor-pointer">
            {{ $location->name }}
        </span>
    @endforeach
    @foreach ($notelette->npc as $npc)
        <span  x-data="{}" x-on:click="Livewire.emit('showModal', 'npcs', {{ $npc->id }})" class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1 cursor-pointer">
            {{ $npc->name }}
        </span>
    @endforeach
    @foreach ($notelette->quest as $quest)
        <span  x-data="{}" x-on:click="Livewire.emit('showModal', 'quests', {{ $quest->id }})" class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1 cursor-pointer">
            {{ $quest->title }}
        </span>
    @endforeach
    @foreach ($notelette->item as $item)
        <span  x-data="{}" x-on:click="Livewire.emit('showModal', 'inventory-items', {{ $item->id }})" class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1 cursor-pointer">
            {{ $item->name }}
        </span>
    @endforeach
    @foreach ($notelette->organization as $organization)
        <span  x-data="{}" x-on:click="Livewire.emit('showModal', 'organizations', {{ $organization->id }})" class="text-xs italic bg-slate-200 rounded border border-slate-400 m-1 cursor-pointer">
            {{ $organization->name }}
        </span>
    @endforeach
</div>
