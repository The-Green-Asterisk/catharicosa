<div>
    
    <div id="loginContainer" class="container">
        <div class="content">
            <br>
            <form wire:submit.prevent="$emit('sessionStore')" class="login-form">
                <label hidden for="email">Email Address</label>
                <input type="text" id="email" name="email" wire:model="email" class="login-inputs" placeholder="email" autocomplete="email">
                @error('email') <span class="error">{{ $message }}</span> @enderror
                <br>
                <label hidden for="password">Password</label>
                <input type="password" id="password" name="password" wire:model="password" class="login-inputs" placeholder="password" autocomplete="current-password">
                @error('password') <span class="error">{{ $message }}</span> @enderror
                <br>
                <input class="remember-checkbox" type="checkbox" id="remember" name="remember" wire:model="remember">
                <label  for="remember">Remember Me</label><br />
                <br>
                <a class="pass" href="/forgot-password">I forgot my password...</a>
                <br>
                <input type="hidden" name="timezone" id="timezone" wire:model="timezone" x-init="$wire.timezone = moment.tz.guess()">

                <hr>
                <x-form-button class="login-pg-btn">Log In</x-form-button>
            </form>
        </div>
    </div>
    <div id="footer">
        <div id="text">
            <img src="/images/asterisk.png"/>
            <p>A product of <a href="https://thegreenasterisk.com" >The Green Asterisk</a></p>
            <a href="/help">About</a>
        </div>
    </div>

    <script>
        var email = document.getElementById("email");
        var loginBtn= document.getElementById("loginBtn");
        if(typeof(email) != 'undefined' && email != null) {
            loginBtn.style.display  = "none";
        }
    </script>
</div>