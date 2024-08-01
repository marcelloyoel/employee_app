@extends('partials.bodypage')
@section('header')
    @include('partials.header')
@endsection
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('container')
    @yield('content')
@endsection
@section('footer')
    @include('partials.footer')
@endsection

