<!-- email-input.blade.php -->
<form method="POST" action="{{ route('send.registration.email') }}">
    @csrf
    <label for="email">Enter User's Email:</label>
    <input type="email" name="email" required />
    <button type="submit">Send Registration Email</button>
</form>
