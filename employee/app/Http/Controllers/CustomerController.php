<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use App\Mail\WelcomeEmail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loyal = Customer::where('status', 1)->where('active', 1)->count();
        $new = Customer::where('status', 0)->where('active', 1)->count();
        return view('dashboard.customer.customer', [
            'title' => 'List Customer',
            'customers' => Customer::where('active', 1)->get(),
            'table'  => 'Ada',
            'chart' => 'Ada',
            'javascript'    => 'login/customer.js',
            'loyal' => $loyal,
            'new'   => $new
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
        try {
            // Validate the incoming request data
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
            $customer = Customer::create(array_merge($validated, ['user_id' => $user_id]));

            Log::info('(CustomerController) Dispatching SendWelcomeEmail job for customer email: ' . $customer->email);
            dispatch(new SendWelcomeEmail($customer->email, $customer->status));
            Log::info('(CustomerController) SendWelcomeEmail job dispatched');

            // Return a JSON response to the AJAX request
            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully! A welcome email has been sent.',
            ], 201);
        } catch (\Exception $e) {
            // Handle exceptions and return a JSON error response
            Log::error('(CustomerController) Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
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
            'javascript'    => 'login/editcustomer.js'
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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email,' . $customer->user_id . ',user_id',
                'status' => 'required|boolean',
            ]);
            Customer::where('user_id', $customer->user_id)->update($validated);
            $updatedCustomer = Customer::where('user_id', $customer->user_id)->first();
            if ($updatedCustomer->status == 1) {
                Log::info('(CustomerController)Dispatching SendWelcomeEmail job for customer email: ' . $updatedCustomer->email);
                dispatch(new SendWelcomeEmail($updatedCustomer->email, $updatedCustomer->status));
                Log::info('(CustomerController)SendWelcomeEmail job dispatched');
            }
            // return redirect('/customer')->with('update', 'Data berhasil diupdate!');
            return response()->json(['success' => true, 'message' => 'Customer edited successfully!']);
        } catch (\Exception $e) {
            // Handle exceptions and return a JSON error response
            Log::error('(CustomerController) Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $nonaktif = [
            'active'    => 0
        ];
        Customer::where('user_id', $customer->user_id)->update($nonaktif);
        return redirect('/customer')->with('delete', 'Customer deleted successfully!');
    }
}
