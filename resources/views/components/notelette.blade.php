@props(['notelette'])
<div class="flex justify-between">
    <p class="italic bg-red-100 w-fit rounded border border-red-300 m-1">{{ $notelette->body }}</p>
    <form method="POST" id="{{ 'delete' . $notelette->id }}" action="/notelette/{{ $notelette->id }}/delete">
        @csrf
        @method('DELETE')
        <x-form-button class="text-xs">Delete</x-form-button>
    </form>
</div>
