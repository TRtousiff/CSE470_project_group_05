<form method="POST" action="{{ route('register') }}">
    @csrf
    <!-- Name input -->
    <input type="text" name="name" required>
    <!-- Email input -->
    <input type="email" name="email" required>
    <!-- Password input -->
    <input type="password" name="password" required>
    <!-- Confirm Password input -->
    <input type="password" name="password_confirmation" required>
    <!-- Submit button -->
    <button type="submit">Register</button>
</form>
