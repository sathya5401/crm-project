<!-- resources/views/customers/index.blade.php -->
<h1>Customers</h1>

<a href="{{ route('customers.create') }}">Add New Customer</a>

<ul>
    @foreach ($customers as $customer)
        <li>
            {{ $customer->name }} - {{ $customer->email }}
            <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>