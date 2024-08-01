@extends('partials.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Customer</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/customer/{{ $customer->user_id }}" enctype="multipart/form-data" id="submitForm">
                        @method('put')
                        @csrf
                        <div class="alertNih">
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-md-6">
                                <label for="user_id" class="form-label">Id Customer: </label>
                                <input value="{{ $customer->user_id }}" type="text" class="form-control" name="user_id" id="user_id" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="name" class="form-label">Nama Lengkap: </label>
                                <input value="{{ old('name', $customer->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Isi nama lengkap yang sesuai" required>
                                @error('name')
                                    <div class="invalid-feedback mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Email Aktif: </label>
                                <input value="{{ old('email', $customer->email) }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Isi email" required>
                                @error('email')
                                    <div class="invalid-feedback mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="status" class="form-label">Status Customer: </label>
                                <select data-choices name="status" id="status">
                                    <option @if($customer->status == 0) {{ 'selected' }} @endif value="0">New Customer</option>
                                    <option @if($customer->status == 1) {{ 'selected' }} @endif value="1">Loyal Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 text-center">
                                <button type="button" class="btn btn-primary btn-block" id="submitBtn">
                                    Submit Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
