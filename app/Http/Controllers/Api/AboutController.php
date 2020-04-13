<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
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
        $about = About::where('role','about')->where('is_active', 1)->get() ;

        if($about){
            return $this->apiResponse($about, 200 );
        }else{
            return $this->apiResponse(null,404,'No About Found');
        }

    }


}
