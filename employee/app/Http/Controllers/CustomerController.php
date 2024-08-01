<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.customer.customer', [
            'title' => 'List Customer',
            'customers' => Customer::all(),
            'table'  => 'Ada'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customer.addcustomer', [
            'title' => 'Add Customer',
            'javascript'    => 'login/addcustomer.js'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('ho');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'status' => 'required|boolean',
        ]);
        $datePrefix = now()->format('dmY'); // Get the date in ddmmyy format
        $lastCustomer = Customer::where('user_id', 'like', $datePrefix . '%')
            ->orderBy('user_id', 'desc')
            ->first();
        // Generate the next incrementing number
        $nextIncrement = '001';
        if ($lastCustomer) {
            $lastNumber = (int) substr($lastCustomer->user_id, -3);
            $nextIncrement = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        // Combine date prefix with incrementing number
        $user_id = $datePrefix . $nextIncrement;
        // dd($user_id);
        // Create a new customer record
        // $customer = Customer::create(array_merge($validated, ['user_id' => $user_id]));
        Customer::create(array_merge($validated, ['user_id' => $user_id]));

        // Handle response
        return redirect('/customer')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customer.editcustomer', [
            'customer'  => $customer,
            'title' => 'Edit Customer',
            'javascript'    => 'login/addcustomer.js'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->user_id . ',user_id',
            'status' => 'required|boolean',
        ]);
        Customer::where('user_id', $customer->user_id)->update($validated);
        return redirect('/customer')->with('update', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
