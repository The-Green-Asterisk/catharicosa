<x-layout>
    <div>
        <x-panel class="w-screen md:w-1/4 mt-20 text-center p-4">
            Lost the key to your room, eh? No worries; happens all the time! Just sign this form and we'll get a new one made for ya.
            <form action="/forgot-password" method="POST">
                @csrf

                <input type="text" name="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="enter email address" autocomplete="email">
                @error('email') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

                <hr />

                <x-form-button>Send verification email</x-form-button>
                <x-secondary-button href="/">Nevermind</x-secondary-button>
            </form>
        </x-panel>
    </div>
</x-layout>
