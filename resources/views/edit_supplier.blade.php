@extends('layouts.layout')


@push('custom_css')

@endpush



@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title float-left">Add Supplier</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="/edit-supplier/{{$supplier->id}}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Supplier Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name"  value="{{$supplier->name}}">
                                    <small class="error">{{$errors->first('name')}}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="company"  value="{{$supplier->company}}">
                                    <small class="error">{{$errors->first('company')}}</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="email"  value="{{$supplier->email}}">
                                    <small class="error">{{$errors->first('email')}}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="phone"  value="{{$supplier->phone}}">
                                    <small class="error">{{$errors->first('phone')}}</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" >{{$supplier->address}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="display-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_active" value="1"
                                               {{ $supplier->is_active == 1 ? 'checked':''}}>
                                        <label class="form-check-label" for="product_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_inactive"
                                               value="0" {{$supplier->is_active == 0 ? 'checked':''}}>
                                        <label class="form-check-label" for="product_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Edit Supplier</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')
@endpush
