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
        $request->validate([
            // Add your validation rules here
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'registration_no' => 'required',
            'website_url'=> 'required',
            'fax_no' => 'required',
            'pic' => 'required',
            'pic_phone' => 'required',
            'designation' => 'required',
            'Company' => 'required',
            'category' => 'required',
        ]);


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

        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
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

    public function show()
    {
        $upstreamCount = Customers::where('category', 'upstream')->count();
        $midstreamCount = Customers::where('category', 'midstream')->count();
        $downstreamCount = Customers::where('category', 'downstream')->count();
        $total = Customers::count();
    
        return view('customers.data', [
            'upstream' => $upstreamCount, 
            'midstream' => $midstreamCount, 
            'downstream' => $downstreamCount, 
            'total' => $total
        ]);
    }
    
}
