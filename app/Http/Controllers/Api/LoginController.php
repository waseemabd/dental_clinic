<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
//use Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use ApiResponseTrait;
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $patientId= $user->related_patient;
            $token =  $user->createToken('MyApp')-> accessToken;

//            return response()->json(['success' => $success], $this-> successStatus);
            return $this->apiResponse(compact(['patientId','token']), 200 );

        }
        else{
//            return response()->json(['error'=>'Unauthorised'], 401);
            return $this->apiResponse(null,401, 'Unauthorised' );
        }
    }


//    use AuthenticatesUsers;
//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = '/';
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//
//    public function __construct()
//    {
//
//
//        $this->middleware('guest')->except('logout');
//    }
//
//
//    public function showLoginForm()
//    {
//
//    }




}
