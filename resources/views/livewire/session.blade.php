<div>
    @auth
        <button wire:click="destroy" class="bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 m-2 text-white shadow-lg active:shadow active:scale-95">Log Out</button>
    @else
        <div x-data="{ open: false, toggle() { this.open =! this.open } }">
            <button @click="toggle()" class="bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 m-2 text-white shadow-lg active:shadow active:scale-95">Log In</button>
            <div x-init="open=false" x-show="open" class="static">
                <x-dialog class="text-center">
                    <form wire:submit.prevent="$emit('sessionStore')">
                        <input type="text" wire:model="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="email" autocomplete="email">
                        @error('email') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

                        <input type="password" id="password" name="password" wire:model="password" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="password" autocomplete="current-password">
                        @error('password') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

                        <hr />

                        <x-form-button>Log In</x-form-button>
                    </form>
                </x-dialog>
            </div>
        </div>
    @endauth
</div>
