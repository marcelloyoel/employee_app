@extends('partials.content')
@section('content')
    @php
        echo "<script>let newCustJs = " . $new . "; let loyalCustJs = " . $loyal . ";</script>";
    @endphp
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
                    @elseif(session('update'))
                        <div class="alert alert-success">
                            {{ session('update') }}
                        </div>
                    @elseif(session('delete'))
                        <div class="alert alert-success">
                            {{ session('delete') }}
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
                                    <th>Created At</th>
                                    <th>Updated At</th>
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
                                        <td>{{ $customer->created_at->timezone('Asia/Bangkok')->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ $customer->updated_at->timezone('Asia/Bangkok')->format('Y-m-d H:i:s') }}</td>
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
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">New Customer vs Loyal Customer Donut Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="doughnut1" class="chartjs-chart" data-colors='["--vz-primary", "--vz-light"]'></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">New Customer vs Loyal Customer Pie Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="pieChart1" class="chartjs-chart" data-colors='["--vz-success", "--vz-light"]'></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

