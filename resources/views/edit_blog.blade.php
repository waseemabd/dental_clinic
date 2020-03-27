@extends('layouts.layout')

@push('custom_css')

@endpush

@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Blog</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form  method="post" action="/edit-blog/{{$blog->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Blog Title <span class="text-danger">*</span></label>
                            <input class="form-control" name="title" type="text" value="{{$blog->title}}">
                            <small class="error">{{$errors->first('title')}}</small>
                        </div>
                        <div class="form-group">
                            <label>Blog Images</label>
                            <div>
                                <input class="form-control-file" name="image" type="file" id="image-input" >
                                <small class="form-text text-muted">Max. file size: 50 MB. Allowed images: jpg, gif, png. Maximum 10 images only.</small>
                                <small class="error">{{$errors->first('image')}}</small>

                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">
                                    <div class="product-thumbnail">
                                        <img src="{{$blog->image}}" id="output" class="img-thumbnail img-fluid" alt="">
                                        <span class="product-remove" title="remove"><i class="fa fa-close"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Blog Description <span class="text-danger">*</span></label>
                            <textarea cols="30" rows="6" name="description" class="form-control">{{$blog->description}}</textarea>
                            <small class="error">{{$errors->first('description')}}</small>

                        </div>

                        <div class="form-group">
                            <label class="display-block">Blog Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="blog_active" value="1" {{$blog->is_active=='1'?'checked':''}}>
                                <label class="form-check-label" for="blog_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="blog_inactive" value="0" {{$blog->is_active=='0'?'checked':''}}>
                                <label class="form-check-label" for="blog_inactive">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Edit Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')

    <script src="/js/select2.min.js"></script>
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
