<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    use ApiResponseTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $blogs = Blog::all();

        if($blogs){
            return $this->apiResponse($blogs, 200 );
        }else{
            return $this->apiResponse(null,404,'No Blog Found');
        }
    }


    public function show(Request $request)
    {
        //

        $id = $request->input('blogtId');
        $blog= Blog::find($id);


        if($blog){
            return $this->apiResponse($blog, 200 );
        }else{
            return $this->apiResponse(null,404,'No Blog Found');
        }


    }


}
