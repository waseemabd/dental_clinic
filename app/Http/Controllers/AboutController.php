<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//       dd(About::where('role','about')->where('is_active', 1)->get());
        $about = About::where('role','about')->where('is_active', 1)->first() ? About::where('role','about')->where('is_active', 1)->first() : new About();

//        dd($about[0]);
//        $about = $about[0];
        return view("about",compact('about'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("add_about");
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

        $about = new About();
        $about->role = "about";

        $about->title = $request->input('title');

        $about->description = $request->input('description');
        $about->email = $request->input('email');
        $about->phone = $request->input('phone');
        $about->address = $request->input('address');


//        $about->image = $request->input('image');
        $status = $request->input('status');
        $about->is_active = isset($status)? $status : 1 ;

        $this->validate(
            $request,
            [
                'title'=> 'required',
                'description' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required',
                'email' => 'email',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if(isset($request->image)){

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images')."/about", $imageName);
            $about->image ='/images/about/'.$imageName;
        }


        if($about->save()){
            return redirect('/about-us');
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

        $about = About::find($id);
        return view("edit_about",compact('about'));
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
        $about = About::find($id);

        $about->title = $request->input('title');


        $about->description = $request->input('description');
        $about->email = $request->input('email');
        $about->phone = $request->input('phone');
        $about->address = $request->input('address');

//        $about->image = $request->input('image');
        $status = $request->input('status');
        $about->is_active = isset($status)? $status : 1 ;

        $this->validate(
            $request,
            [
                'title'=> 'required',
                'description' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required',
                'email' => 'email',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if(isset($request->image)){

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images')."/about", $imageName);
            $about->image ='/images/about/'.$imageName;
        }

        if($about->save()){
            return redirect('/about-us');
        }
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
    }
}
