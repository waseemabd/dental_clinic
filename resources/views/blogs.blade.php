@extends('layouts.layout')

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">
@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-8 col-4">
                    <h4 class="page-title">Blog</h4>
                </div>
                <div class="col-sm-4 col-8 text-right m-b-30">
                    <a class="btn btn-primary btn-rounded float-right" href="/add-blog"><i class="fa fa-plus"></i> Add Blog</a>
                </div>
            </div>
            <div class="row">

                @foreach($blogs as $blog)
                <div class="col-sm-6 col-md-6 col-lg-4" id="div-{{$blog->id}}">
                    <div class="blog grid-blog">
                        <div class="blog-image">
                            <a href="/view-blog/{{$blog->id}}"><img class="img-fluid" src="{{$blog->image}}" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title"><a href="/view-blog/{{$blog->id}}">{{$blog->title}}</a></h3>
                            <p>{{$blog->description}}</p>
                            <a href="/view-blog/{{$blog->id}}" class="read-more"><i class="fa fa-long-arrow-right"></i> Read More</a>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-calendar"></i> <span>{{$blog->created_at? $blog->created_at : $blog->updated_at}}</span></a></li>
                                    </ul>
                                </div>
                                <div class="post-right">

                                    <input type="checkbox" class="form-control is_active"  name="is_active"
                                           data-toggle="toggle" data-onstyle="success" data-id="{{$blog->id}}"
                                           data-style="ios" data-offstyle="danger" data-on="Active" data-off="Inactive" {{$blog->is_active?'checked':''}}>

                                    <a class="btn btn-outline-primary" href="/edit-blog/{{$blog->id}}">Edit</a>
                                    <a class="btn btn-danger" data-id="{{$blog->id}}" data-toggle="modal"
                                       data-target="#delete_blog" href="#"> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>

    <div id="delete_blog" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/images/sent.png" alt="" width="50" height="46">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h3>Are you sure want to delete this Appointment?</h3>
                    <div class="m-t-20"><a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger" id="delete_btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('custom_scripts')
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script>

        $(document).ready(function () {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $('.is_active').on('change',function (e) {
                console.log($(this).is(':checked'));
                let blog_id = $(this).data('id');
                let status = $(this).is(':checked') ? 1:0;

                $.ajax({
                    type: 'post',
                    url: "/blogChangeStatus/" + blog_id,
                    data:{
                        status: status
                    },
                    success: function (response) {
                        if (response.status === 1) {

                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });


            })

            $('#delete_blog').on('show.bs.modal', function (e) {

                let blog_id = $(e.relatedTarget).data('id');
                console.log(blog_id);
                $('#delete_btn').data('id', blog_id);


            });




            $("#delete_btn").on('click', function (e) {

                e.preventDefault();

                let blog_id = $("#delete_btn").data('id');
                console.log();

                $.ajax({
                    type: 'delete',
                    url: "/delete-blog/" + blog_id,


                    success: function (response) {
                        if (response.status === 1) {
                            console.log(response.status + " | " + response.message);
                            $('#delete_blog').modal('hide');
                            $('#div-' + blog_id).hide();
                        } else {
                            alert("something went wrong");
                        }


                    },
                    error: function (jqXHR) {
                        console.log(jQuery.parseJSON(jqXHR.responseText).message);
                        alert(jQuery.parseJSON(jqXHR.responseText).message);

                    }
                });
            });

        });
    </script>
@endpush




