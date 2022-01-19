<x-layout>
    <div>
        <x-panel class="w-screen md:w-1/4 mt-20 text-center p-4">
            Lost the key to your room, eh? No worries; happens all the time! Just sign this form and we'll get a new one made for ya.
            <form action="/reset-password" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label hidden for="email">Email Address</label>
                <input type="text" name="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="enter email address" autocomplete="email">
                @error('email') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

                <label hidden for="password">Enter New Password</label>
                <input type="password" id="password" name="password" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="enter new password" autocomplete="new-password">
                @error('password') <span class="error text-xs text-red-600">{{ $message }}</span> @enderror

                <label hidden for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="confirm password">

                <hr />

                <x-form-button>Venture Forth</x-form-button>
                <x-secondary-button href="/">Nevermind</x-secondary-button>
            </form>
        </x-panel>
    </div>
</x-layout>
