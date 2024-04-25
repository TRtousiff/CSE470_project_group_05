<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Email input -->
    <input type="email" name="email" required autofocus>
    <!-- Password input -->
    <input type="password" name="password" required>
    <!-- Submit button -->
    <button type="submit">Log in</button>
</form>
