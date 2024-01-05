<!-- resources/views/inquiry/create.blade.php -->
<form method="POST" action="{{ url('/inquiries') }}">
    @csrf
    <textarea name="message" placeholder="Your Message"></textarea>
    <button type="submit">Submit Inquiry</button>
</form>

