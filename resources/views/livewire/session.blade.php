<div>
    @auth
        <form method="POST" action="/logout">
            @csrf

            <button type="submit" class="whitespace-nowrap bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 my-2 text-white shadow-lg active:shadow active:scale-95">Log Out</button>
        </form>
    @else
        <div x-data="{ open: false, toggle() { this.open =! this.open } }">
            <button @click="toggle()" class="whitespace-nowrap bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 m-2 text-white shadow-lg active:shadow active:scale-95">Log In</button>
            <div x-init="open=false" x-show="open" class="static">
                <x-dialog class="text-center md:w-96">
                    <form wire:submit.prevent="$emit('sessionStore')">
                        @csrf

                        <input type="text" wire:model="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="email" autocomplete="email">
                        @error('email') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror

                        <input type="password" id="password" name="password" wire:model="password" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="password" autocomplete="current-password">
                        @error('password') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror

                        <input type="checkbox" id="remember" name="remember" wire:model="remember">
                        <label for="remember">Remember Me</label><br />

                        <a href="/forgot-password" class="text-sm italic hover:underline">I forgot my password...</a>

                        <input type="hidden" name="timezone" id="timezone" wire:model="timezone" x-init="$wire.timezone = moment.tz.guess()">

                        <hr />

                        <x-form-button>Log In</x-form-button>
                    </form>
                </x-dialog>
            </div>
        </div>
    @endauth
</div>
