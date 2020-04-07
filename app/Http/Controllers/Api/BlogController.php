<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $blogs = Blog::all();

        //response
//        return view('blogs',compact('blogs'));
    }


    public function show($id)
    {
        //
        $blog= Blog::find($id);
//response
//        return view('view-blog',compact('blog'));

    }


}
