<!-- resources/views/customers/edit.blade.php -->
<h1>Edit Customer</h1>

<form method="POST" action="{{ route('customers.update', $customer->id) }}">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $customer->name }}" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ $customer->email }}" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="{{ $customer->phone }}">

    <button type="submit">Update Customer</button>
</form>