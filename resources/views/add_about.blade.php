@extends('layouts.layout')

@push('custom_css')


@endpush



@section('content')



    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title float-left">Edit About Us</h4>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="/add-about"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                    <small class="error">{{$errors->first('title')}}</small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" type="email" value="{{old('email')}}">
                                    <small class="error">{{$errors->first('email')}}</small>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input class="form-control" name="phone" type="text" value="{{old('phone')}}">
                                    <small class="error">{{$errors->first('phone')}}</small>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control " value="{{old('address')}}">
                                    <small class="error">{{$errors->first('address')}}</small>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" style="height: 200px">{{old('description')}}</textarea>
                                    <small class="error">{{$errors->first('description')}}</small>

                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="profile-upload">
                                        <div class="upload-input">
                                            <input class="form-control-file" name="image" type="file" id="image-input">
                                            <small class="error">{{$errors->first('image')}}</small>

                                        </div>
                                    </div>
                                    <div class="product-thumbnail col-sm-6">
                                        <img src="" id="output" class="img-thumbnail img-fluid" alt="">
                                        <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="display-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_active" value="1" checked disabled>
                                        <label class="form-check-label" for="product_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                               id="product_inactive" disabled>
                                        <label class="form-check-label" for="product_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Add About</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')
    <script>
        $(document).ready(function () {


            $('#image-input').on('change',function (event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('output');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);


            });

            $(".product-remove").on('click',function(){
                $(this).parents(".product-thumbnail").remove();
                $('#image-input').val("");
            });

        });

    </script>
@endpush




