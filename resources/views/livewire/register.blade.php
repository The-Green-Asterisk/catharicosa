<div>
    <x-panel class="w-1/4 mt-20 text-center p-4">
        Thank you for patronizing this humble tavern! Please enter the following information so we can personalize your experience here at Catharicosa Notes!
        <form wire:submit.prevent="submit">
            <input type="text" wire:model="name" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="name" autocomplete="name">
            @error('name') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <input type="text" wire:model="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="email" autocomplete="email">
            @error('email') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <input type="password" id="password" name="password" wire:model="password" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="password" autocomplete="new-password">
            @error('password') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

            <input type="password" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="confirm password">

            <input type="hidden" name="timezone" id="timezone" wire:model="timezone" x-init="$wire.timezone = moment.tz.guess()">

            <hr />

            <x-form-button>Venture Forth</x-form-button>
            <x-secondary-button href="/">Nevermind</x-secondary-button>
        </form>
    </x-panel>
</div>
