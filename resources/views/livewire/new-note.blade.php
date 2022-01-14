<div x-data="{ open: false, toggle() { this.open =! this.open } }" class="m-auto justify-center text-center">
    <x-anchor-button href="#" @click="toggle()">+</x-anchor-button>
    <form wire:submit.prevent="submit">
        <div class="lg:mx-10 2xl:mx-32 md:mx-32 mx-10 my-10 transition-all duration-500" x-show="open">
            <input type="text" wire:model="title" class="shadow-inner outline-gray-200 w-full font-bold rounded" value="Notes for {{ now()->tz(auth()->user()->timezone)->toDayDateTimeString() }}" />
            <textarea wire:model="body" wire:keydown.ctrl.enter="submit" class="shadow-inner w-full h-48 outline-gray-200 rounded" placeholder="Along our way we discovered a small town with a lively tavern. Perhaps TOO lively..."></textarea>
            <div class="flex">
                <div class="flex text-left text-xs italic">
                    <ul  class="list-disc list-inside">
                        Things to keep in mind:
                        <li>Ctrl+Enter will save the note.</li>
                        <li>Note must be saved before notelettes can be created.</li>
                        <li>Don't worry, you can continue your note after it's saved!</li>
                        <li>Notelettes can be created at any point after the initial save by selecting a portion of the note, right-clicking, and selecting an association.</li>
                    </ul>
                    </div>
                <div class="grow"></div>
                <x-form-button class="my-auto">Save</x-form-button>
            </div>
        </div>
    </form>
</div>
