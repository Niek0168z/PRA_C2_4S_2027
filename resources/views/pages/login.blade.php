<x-layouts.app>
    <h1>Inloggen</h1>

    <form method="POST" action="{{ route('login.authenticate') }}">
        @csrf

        <div class="form-group">
            <label for="email">E-mailadres</label>
            <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
            @error('password')
                <p role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="checkbox">
            <label for="remember">
                <input id="remember" name="remember" type="checkbox" value="1">
                Aangemeld blijven
            </label>
        </div>

        <button class="btn btn-primary" type="submit">Inloggen</button>
    </form>
</x-layouts.app>
