<div
    class="w-screen h-screen fixed inset-0 z-30 backdrop-blur-sm flex content-center overscroll-auto overflow-scroll overscroll-auto">
    <x-panel @click.away="open = false" {{ $attributes->merge(['class' => 'z-50 md:w-72 w-screen p-4']) }}>
        {{ $slot }}
    </x-panel>
</div>
