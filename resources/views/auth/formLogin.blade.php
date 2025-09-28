<!-- resources/views/auth/_login_form.blade.php -->
<form id="login-form" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email" required
            autofocus>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <input id="password" name="password" type="password" placeholder="Password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Login</button>
</form>
