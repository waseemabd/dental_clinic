<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $id = $request->input('id');
        $user= User::find($id);

        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');

        $user->password = bcrypt($newPassword);

        $this->validate(
            $request,
            [

                'oldPassword' => ['required',function($attribute, $value, $fails,$user){

                    if(!Hash::check($value,$user->password)){
                        return $fails( 'Old password didn\'t match');
                    }
                }],
                'newPassword' => 'required',
                'confirmPassword' => 'same:newPassword',
            ]
        );

        if($user->save()){
//            return redirect('/dashboard'); response
        }

    }



}
