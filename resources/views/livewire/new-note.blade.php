<div x-data="{ open: false, toggle() { this.open =! this.open } }" class="m-auto justify-center text-center">
    <x-anchor-button href="#" @click="toggle()">+</x-anchor-button>
    <form wire:submit.prevent="submit">
        <div class="mx-32" x-show="open">
            <input type="text" wire:model="title" class="shadow-inner w-full font-bold rounded" value="Notes for {{ now()->toDayDateTimeString() }}" />
            <textarea wire:model="body" wire:keydown.enter="submit" class="shadow-inner w-full rounded" placeholder="Along our way we discovered a small town with a lively tavern. Perhaps TOO lively..."></textarea>
        </div>
    </form>
</div>
