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
            <br>
            <form wire:submit.prevent="$emit('sessionStore')" class="login-form">
                @csrf

                <label hidden for="email">Email Address</label>
                <input type="text" name="email" wire:model="email" class="login-inputs" placeholder="email" autocomplete="email">
                @error('email') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror
                <br>
                <label hidden for="password">Password</label>
                <input type="password" id="password" name="password" wire:model="password" class="login-inputs" placeholder="password" autocomplete="current-password">
                @error('password') <span class="error text-xs text-red-600 block w-full">{{ $message }}</span> @enderror
                <br>
                <input type="checkbox" id="remember" name="remember" wire:model="remember">
                <label for="remember">Remember Me</label><br />
                <br>
                <a href="/forgot-password" class="text-sm italic hover:underline">I forgot my password...</a>
                <br>
                <input type="hidden" name="timezone" id="timezone" wire:model="timezone" x-init="$wire.timezone = moment.tz.guess()">

                <hr>
                <x-form-button>Log In</x-form-button>
            </form>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("loginModal");

        // Get the button that opens the modal
        var btn = document.getElementById("loginBtn");
        var center = document.getElementsByClassName("center")[0];
       
        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
            center.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        function hideLogin() {
            document.getElementById("loginModal").style.display="none";
            center.style.display = "none";
        }
        </script>
    @endauth
</div>