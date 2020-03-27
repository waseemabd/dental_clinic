@extends('layouts.auth_template')

@push('custom_css')


@endpush



@section('content')


    <div class="error-box">
        <form action="http://dreamguys.co.in/preclinic/template/index.html">
            <div class="lock-user">
                <img class="rounded-circle" src="assets/img/user.jpg" alt="">
                <h6>John Doe</h6>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Enter Password" type="password">
            </div>
            <div class="text-center">
                <a href="login.html">Sign in as a different user?</a>
            </div>
        </form>
    </div>

@endsection

@push('custom_scripts')

@endpush




