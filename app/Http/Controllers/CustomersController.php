<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $customers = Customers::all();
        $query = Customers::query();

        // Check if a category filter is applied
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $customers = $query->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $customer = new Customers;
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
        $customer->Company = $request->Company;
        $customer->category = $request->category;
        //$customer->reference = $request->reference;
        $customer->save();

        return redirect()->route('customers.index');
    }

    public function edit(Customers $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {   
        $customer = Customers::find($id);
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
        $customer->Company = $request->Company;
        $customer->category = $request->category;
        //$customer->reference = $request->reference;

        $customer->save();

        return redirect()->route('customers.index');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
