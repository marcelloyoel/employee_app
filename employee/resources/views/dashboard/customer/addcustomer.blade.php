@extends('partials.content')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Customer</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/customer" enctype="multipart/form-data" id="submitForm">
                        @csrf
                        <div class="alertNih">
                        </div>
                        <input type="hidden" name="status" value="0">
                        <div class="row">
                            <div class=" col-12 col-md-6">
                                <label for="name" class="form-label">Nama Lengkap: </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Isi nama lengkap yang sesuai" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Email Aktif: </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Isi email" required>
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
