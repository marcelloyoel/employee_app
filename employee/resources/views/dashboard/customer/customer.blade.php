@extends('partials.content')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0 flex-grow-1">Data Customer</h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @else
                        <div class="alert alert-success">
                            {{ session('update') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-end">
                        <a href="customer/create" class="btn btn-primary mb-3">Add New Customer</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Customer's Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status (Loyalty)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr class="">
                                        <td class="sorting_1">{{ $customer->user_id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            @if ($customer->status == 0)
                                                <span class="badge text-lg-center text-bg-success">{{ "New Customer" }}</span>
                                            @else
                                                <span class="badge text-lg-center text-bg-info">{{ "Loyal Customer" }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="/customer/{{ $customer->user_id }}/edit"
                                                class="btn btn-warning btn-circle mx-2">
                                                <i class="las la-pencil-alt"></i>
                                            </a>
                                            <form action="/customer/{{ $customer->user_id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-circle" type="submit"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="las la-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection

