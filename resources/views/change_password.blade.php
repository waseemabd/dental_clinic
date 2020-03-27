@extends('layouts.layout')

@push('custom_css')


@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h4 class="page-title">Change Password</h4>
                    <form method="POST" action="/changePassword">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Old password</label>
                                    <input type="password" class="form-control" name="oldPassword">
                                    <small class="error">{{$errors->first('oldPassword')}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>New password</label>
                                    <input type="password" class="form-control" name="newPassword">
                                    <small class="error">{{$errors->first('newPassword')}}</small>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm password</label>
                                    <input type="password" class="form-control" name="confirmPassword">
                                    <small class="error">{{$errors->first('confirmPassword')}}</small>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center m-t-20">
                                <button type="submit" class="btn btn-primary submit-btn">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('custom_scripts')

@endpush




