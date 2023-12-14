<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email ?? 'default@email.com'; // Default value if email is not provided
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->registration_no = $request->registration_no;
        $customer->website_url = $request->website_url;
        $customer->fax_no = $request->fax_no;
        $customer->pic = $request->pic;
        $customer->pic_phone = $request->pic_phone;
        $customer->designation = $request->designation;
        $customer->save();

        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email ?? 'default@email.com'; // Default value if email is not provided
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->registration_no = $request->registration_no;
        $customer->website_url = $request->website_url;
        $customer->fax_no = $request->fax_no;
        $customer->pic = $request->pic;
        $customer->pic_phone = $request->pic_phone;
        $customer->designation = $request->designation;
        $customer->save();

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
