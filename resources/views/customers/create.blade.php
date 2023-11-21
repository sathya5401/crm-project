<!-- resources/views/customers/create.blade.php -->
<form method="POST" action="{{ route('customers.store') }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone">

    <button type="submit">Create Customer</button>
</form>