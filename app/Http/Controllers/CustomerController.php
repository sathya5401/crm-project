<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


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

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'phoneNo' => $validatedData['phoneNo'],
            'address' => $validatedData['address'],
            'inv_address' => $validatedData['inv_address'],
            'pic' => $validatedData['pic'],
            'email' => $validatedData['email'],
            'faxNo' => $validatedData['faxNo'],
            'creditLimit' => $validatedData['creditLimit'],
        ]);

        return view('customer.confirm');    }

    // public function index()
    // {
        
    //     $searchTerm = null; // Set the default value for $searchTerm

    //     return view('customer.listing');
    // }
/*
    public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $customer = null;

    if ($searchTerm) {
        $users = User::where('is_admin', 1)
                      ->where(function ($query) use ($searchTerm) {
                          $query->where('name', 'like', '%'.$searchTerm.'%')
                                ->orWhere('email', 'like', '%'.$searchTerm.'%')
                                ->orWhere('role', 'like', '%'.$searchTerm.'%')
                                ->orWhere('branch', 'like', '%'.$searchTerm.'%')
                                ->orWhere('phone_number', 'like', '%'.$searchTerm.'%');
                      })
                      ->get();
    } else {
        $users = User::where('is_admin', 1)->get();
    }

    return view('user.listing', ['users' => $users, 'searchTerm' => $searchTerm]);
}

    public function delete($id)
    {
            if ($customer) {
            $customer->delete();
        }

        return Redirect::back()->with('success', 'Customer deleted successfully.');
    }
*/

public function index(){
    $customerTest = DB::table('customer')->get();
    return view('customer.listing',['customerTest'=>$customerTest]);
}

}