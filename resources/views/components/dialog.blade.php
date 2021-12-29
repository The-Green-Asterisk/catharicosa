<div
    x-show="open"
    class="w-screen h-screen fixed inset-0 z-40 backdrop-blur flex content-center">
    <x-panel @click.away="open = false" class="z-50 w-72 p-4 text-center">
        {{ $slot }}
    </x-panel>
</div>
