<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    use ApiResponseTrait;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('generatePass');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



//    public function viewProfile($id)
//    {
//
////        return view('profile');
//    }



    public function updatePassword(Request $request)
    {
        $id = $request->input('patientId');
        $user= User::where('related_patient',$id)->first();
        $patient = Patient::find($id);

//        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');


        if($user && $newPassword){
            $user->password = bcrypt($newPassword);
            $patient->password = bcrypt($newPassword);

        }else{
            return $this->apiResponse(null,404,'No User Found');
        }

//        $this->validate(
//            $request,
//            [
//
//                'oldPassword' => ['required',function($attribute, $value, $fails,$user){
//
//                    if(!Hash::check($value,$user->password)){
//                        return $fails( 'Old password didn\'t match');
//                    }
//                }],
//                'newPassword' => 'required',
////                'confirmPassword' => 'same:newPassword',
//            ]
//        );

        if($user->save()){
            $patient->save();
            return $this->apiResponse($user, 200 );
        }else{
            return $this->apiResponse(null,406, 'Password Could Not Updated' );
        }

    }



}
