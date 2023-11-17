<div>
    <x-panel >
        <form wire:submit.prevent="submit" class="sign-up-form">
            Thank you for patronizing this humble tavern! Please enter the following information so we can personalize your experience here at Catharicosa Notes!
            </br>
            </br>
            </br>
            <label hidden for="name">Name</label>
            <input type="text" name="name" wire:model="name" class="sign-up-inputs" placeholder="name" autocomplete="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
            </br>
            <label hidden for="email">Email Address</label>
            <input type="text" name="email" wire:model="email" class="sign-up-inputs" placeholder="email" autocomplete="email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
            </br>
            <label hidden for="password">Password</label>
            <input type="password" id="password" name="password" wire:model="password" class="sign-up-inputs" placeholder="password" autocomplete="new-password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
            </br>
            <label hidden for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation" class="sign-up-inputs" placeholder="confirm password">

            <input type="hidden" name="timezone" id="timezone" wire:model="timezone" x-data="{}" x-init="$wire.timezone = moment.tz.guess()">

            <hr />

            <x-form-button>Venture Forth</x-form-button>
            <x-secondary-button href="/">Nevermind</x-secondary-button>
        </form>
    </x-panel>
    <div id="footer">
        <div id="text">
            <img src="/images/asterisk.png"/>
            <p>A product of <a href="https://thegreenasterisk.com" >The Green Asterisk</a></p>
            <a href="/help">About</a>
        </div>
    </div>
</div>
