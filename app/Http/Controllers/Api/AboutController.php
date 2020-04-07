<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Http\Controllers\Controller;
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
        $about = About::first() ? About::first() : new About();

//        dd($about);

//        return view("about",compact('about'));

    }


}
