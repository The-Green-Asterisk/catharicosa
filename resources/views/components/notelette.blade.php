@props(['notelette'])
<div class="flex justify-between">
    <p class="italic bg-red-100 w-fit rounded border border-red-300 m-1">{{ $notelette->body }}</p>
    <form method="POST" id="{{ 'delete' . $notelette->id }}" action="/notelette/{{ $notelette->id }}/delete">
        @csrf
        @method('DELETE')
        <input type="image" src="images/trash.png" alt="Delete" height="15px" width="15px" class="opacity-50 hover:opacity-100" title="Delete Notelette" />
    </form>
</div>
