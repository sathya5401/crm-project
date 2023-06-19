<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phoneNo' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'inv_address' => 'nullable|string|max:255',
            'pic' => 'nullable|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'faxNo' => 'nullable|string|max:255',
            'creditLimit' => 'nullable|string|max:255'

        ]);

        $customer = new Customer();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['phoneNo'];
        $user->name = $validatedData['address'];
        $user->email = $validatedData['inv_address'];
        $user->name = $validatedData['pic'];
        $user->email = $validatedData['email'];
        $user->name = $validatedData['faxNo'];
        $user->email = $validatedData['creditLimit'];
        $user->save();

        Customer::create($validatedData);

        return redirect('/customer/confirmregister');
    }

}