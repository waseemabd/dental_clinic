@extends('layouts.layout')

@push('custom_css')

@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">About Page</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-view">
                        <article class="blog blog-single-post">
                            <h3 class="blog-title">{{$about->title ? $about->title : ''}}</h3>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li><a href="#."><i class="fa fa-calendar"></i>
                                                <span>{{$about->updated_at ? $about->updated_at : $about->created_at}}</span></a>
                                        </li>
                                        <li><span
                                                class="badge-{{$about->is_active ? 'success':'danger'}}">{{$about->is_active ? 'Active':'InActive'}}</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="blog-image">
                                <a href="#."><img alt="" src="{{$about->image}}" class="img-fluid"></a>
                            </div>
                            <div class="blog-content">

                                <p>{{$about->description}}</p>
                            </div>
                            <div class="blog-content">

                                Address: <p>{{$about->address}}</p>
                                Email: <p>{{$about->email}}</p>
                                Phone: <p>{{$about->phone}}</p>
                            </div>
                        </article>
                        <div class="post-right">
                            @if($about->id)
                                <a class="btn btn-outline-primary" href="/edit-about/{{$about->id}}">Edit</a>

                            @else
                                <a class="btn btn-outline-primary" href="/add-about">ADD</a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')

@endpush




