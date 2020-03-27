<?php

namespace App\Http\Controllers;

use App\Blog;
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
        return view('blogs',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('add_blog');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $blog= new Blog();

        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
//        $blog->image = $request->input('image');
        $blog->is_active = $request->input('status');

        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
//        dd($request->image->getClientOriginalExtension());
        if(isset($request->image)){

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images')."/blogs", $imageName);
            $blog->image ='/images/blogs/'.$imageName;
        }


        if($blog->save()){
            return redirect('/blogs');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $blog= Blog::find($id);

        return view('view-blog',compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $blog= Blog::find($id);
//        dd();
        return view('edit_blog',compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $blog= Blog::find($id);

        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
//        $blog->image = $request->input('image');
        $blog->is_active = $request->input('status');

        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );

        if(isset($request->image)){

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images')."/blogs", $imageName);
            $blog->image ='/images/blogs/'.$imageName;
        }

        if($blog->save()){
            return redirect('/blogs');
        }
    }



    public function changeStatus($id,Request $request)
    {
        //
//        dd($id,$request->input('status'));
        $blog= Blog::find($id);
        $blog->is_active = $request->input('status');

        return $blog->save() ? response()->json(['status' => 1, "message" => "status of Blog has been changed successfully"]) : response()->json(['status' => 0, "message" => "failed to change status for Blog"]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Blog::destroy($id) ? response()->json(['status' => 1, "message" => "Blog deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Blog"]);


    }
}
