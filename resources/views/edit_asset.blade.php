@extends('layouts.layout')

@push('custom_css')

    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">

@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title float-left">Add Asset</h4>
                    <a href="/add-supplier" class="btn btn btn-primary btn-rounded float-right"><i
                            class="fa fa-plus"></i>Add New supplier</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="/edit-asset/{{$asset->id}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asset Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name"  value="{{$asset->name}}">
                                    <small class="error">{{$errors->first('name')}}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantitiy <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="quantity"  value="{{$asset->quantity}}">
                                    <small class="error">{{$errors->first('quantity')}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Purchase Date</label>
                                    <input class="form-control datetimepicker" type="text" name="date"  value="{{$asset->movement_date}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="price"  value="{{$asset->price}}">
                                    <small class="error">{{$errors->first('price')}}</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Supplier <span class="text-danger">*</span></label>
                                    <select class="select" name="supplier"  >
                                        <option value="">Select</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}"  {{$asset->supplier_id==$supplier->id ?'selected': ''}}>
                                                {{$supplier->company}}: {{$supplier->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="error">{{$errors->first('supplier')}}</small>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="display-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_active" value="1"
                                            {{$asset->is_active=='1'?'checked':''}}>
                                        <label class="form-check-label" for="product_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_inactive"
                                               value="0" {{$asset->is_active=='0'?'checked':''}}>
                                        <label class="form-check-label" for="product_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" >{{$asset->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Edit Asset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')

    <script src="/js/select2.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
@endpush




