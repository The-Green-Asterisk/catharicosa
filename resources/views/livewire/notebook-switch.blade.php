<div class="w-screen">
    @auth
        <div class="m-3 p-1 items-center overflow-scroll no-scrollbar">
            <div class="text-xs mx-5 uppercase font-semibold">Notebooks:</div>
            <div class="flex items-center">
                @if ($notebookId == null)
                    <div class="rounded-full border border-red-600 bg-red-300 px-3 mx-1 text-lg font-bold cursor-default">All
                    </div>
                @else
                    <div wire:click="notebookSwitch('')"
                        class="rounded-full border border-red-500 bg-red-200 px-3 mx-1 cursor-pointer hover:border-red-600 hover:bg-red-300">
                        All</div>
                @endif
                @foreach ($notebooks as $notebook)
                    @if ($notebook->id == $notebookId)
                        <input type="text"
                            class="rounded-full border border-red-600 bg-red-300 mx-1 text-lg font-bold text-center"
                            wire:model="notebookName" wire:keydown.enter="update"
                            x-data="{ size: $wire.notebookName.length }" :size="size" />
                    @else
                        <div wire:click="notebookSwitch({{ $notebook->id }})"
                            class="rounded-full border border-red-500 bg-red-200 px-3 mx-1 h-min cursor-pointer hover:border-red-600 hover:bg-red-300">
                            {{ $notebook->name }}</div>
                    @endif
                @endforeach
                <div x-data="{ open: false, toggle() { this.open =! this.open } }">
                    <div @click="toggle()"
                        class="rounded-full border border-red-500 bg-red-200 px-2 mx-1 w-fit cursor-pointer hover:border-red-600 hover:bg-red-300"
                        title="New Notebook">+</div>
                    <div x-init="open=false" x-show="open" class="static">
                        <x-dialog class="text-center md:w-96">
                            <input type="text" wire:model="name"
                                class="bg-red-200 border border-red-500 outline-red-500 grow shadow-inner rounded-full indent-2" />
                            <x-form-button wire:click="create()">Create</x-form-button>
                            <hr />
                            <div class="flex my-3 flex-wrap justify-center">
                                @foreach ($notebooks as $notebook)
                                    <div class="flex m-2">
                                        <div>{{ $notebook->name }}</div>
                                        <div wire:click="delete({{ $notebook->id }})"
                                            class="rounded-full border border-red-500 bg-red-200 px-2 scale-90 cursor-pointer hover:border-red-600 hover:bg-red-300"
                                            title="Delete">X</div>
                                    </div>
                                @endforeach
                            </div>
                        </x-dialog>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endauth
</div>
