@extends('layouts.layout')

@push('custom_css')

@endpush



@section('content')


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Blog View</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-view">
                        <article class="blog blog-single-post">
                            <h3 class="blog-title">{{$blog->title}}</h3>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li><a href="#."><i class="fa fa-calendar"></i> <span>{{$blog->updated_at ? $blog->updated_at : $blog->created_at}}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-image">
                                <a href="#."><img alt="" src="{{$blog->image}}" class="img-fluid"></a>
                            </div>
                            <div class="blog-content">

                                <p>{{$blog->description}}</p>
                            </div>
                        </article>

                    </div>
                </div>
{{--                <aside class="col-md-4">--}}

{{--                    <div class="widget post-widget">--}}
{{--                        <h5>Latest Posts</h5>--}}
{{--                        <ul class="latest-posts">--}}
{{--                            <li>--}}
{{--                                <div class="post-thumb">--}}
{{--                                    <a href="blog-details.html">--}}
{{--                                        <img class="img-fluid" src="assets/img/blog/blog-thumb-01.jpg" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="post-info">--}}
{{--                                    <h4>--}}
{{--                                        <a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>--}}
{{--                                    </h4>--}}
{{--                                    <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="post-thumb">--}}
{{--                                    <a href="blog-details.html">--}}
{{--                                        <img class="img-fluid" src="assets/img/blog/blog-thumb-02.jpg" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="post-info">--}}
{{--                                    <h4>--}}
{{--                                        <a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>--}}
{{--                                    </h4>--}}
{{--                                    <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="post-thumb">--}}
{{--                                    <a href="blog-details.html">--}}
{{--                                        <img class="img-fluid" src="assets/img/blog/blog-thumb-03.jpg" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="post-info">--}}
{{--                                    <h4>--}}
{{--                                        <a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>--}}
{{--                                    </h4>--}}
{{--                                    <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="post-thumb">--}}
{{--                                    <a href="blog-details.html">--}}
{{--                                        <img class="img-fluid" src="assets/img/blog/blog-thumb-04.jpg" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="post-info">--}}
{{--                                    <h4>--}}
{{--                                        <a href="blog-details.html">Lorem ipsum dolor sit amet consectetur</a>--}}
{{--                                    </h4>--}}
{{--                                    <p><i aria-hidden="true" class="fa fa-calendar"></i> December 6, 2017</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

{{--                </aside>--}}
            </div>
        </div>

    </div>

@endsection

@push('custom_scripts')
@endpush




