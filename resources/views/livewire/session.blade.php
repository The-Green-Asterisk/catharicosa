<div>
    @auth
        <form method="POST" action="/logout">
            @csrf

            <button type="submit" class="whitespace-nowrap bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 my-2 text-white shadow-lg active:shadow active:scale-95">Log Out</button>
        </form>
    @else
    <button id="loginBtn" >Log in</button>
    <div id="loginModal" class="modal">
        <div class="model-content">
            <span class="close">&times;</span>
            <br>
            <form wire:submit.prevent="$emit('sessionStore')">
                @csrf

                <label hidden for="email">Email Address</label>
                <input type="text" name="email" wire:model="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="email" autocomplete="email">
                @error('email') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror
                <br>
                <label hidden for="password">Password</label>
                <input type="password" id="password" name="password" wire:model="password" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="password" autocomplete="current-password">
                @error('password') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror
                <br>
                <input type="checkbox" id="remember" name="remember" wire:model="remember">
                <label for="remember">Remember Me</label><br />
                <br>
                <a href="/forgot-password" class="text-sm italic hover:underline">I forgot my password...</a>
                <br>
                <input type="hidden" name="timezone" id="timezone" wire:model="timezone" x-init="$wire.timezone = moment.tz.guess()">


                <x-form-button>Log In</x-form-button>
            </form>
        </div>
    </div>
    <script>
        // Get the modal
var modal = document.getElementById("loginModal");

// Get the button that opens the modal
var btn = document.getElementById("loginBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
    @endauth
</div>
<!-- <div x-data="{ open: false, toggle() { this.open =! this.open } }">
            <button @click="toggle()" class="whitespace-nowrap bg-gradient-to-br from-red-500 via-red-500 to-red-600 border border-red-800 rounded-full px-2 m-2 text-white shadow-lg active:shadow active:scale-95">Log In</button>
            <div x-init="open=false" x-show="open" class="popup">
                <x-dialog class="modal-content">
                    <form wire:submit.prevent="$emit('sessionStore')" class="modal">
                        @csrf

                        <label hidden for="email">Email Address</label>
                        <input type="text" name="email" wire:model="email" class="w-full outline-gray-200 shadow-inner rounded my-2" placeholder="email" autocomplete="email">
                        @error('email') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror

                        <label hidden for="password">Password</label>
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
        </div> -->