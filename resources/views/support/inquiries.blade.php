<!-- resources/views/inquiry/create.blade.php -->
<form method="POST" action="{{ url('/inquiries) }}">
    @csrf
    <input type="text" id="id" placeholder="Your ID">
    <input type="text" name="name" placeholder="Your Name">
    <input type="email" name="email" placeholder="Your Email">
    <textarea name="message" placeholder="Your Message"></textarea>
    <button type="submit">Submit Inquiry</button>
</form>

