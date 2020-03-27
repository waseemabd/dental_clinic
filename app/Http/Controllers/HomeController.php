<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }


    public function viewProfile()
    {
        return view('profile');
    }


    public function changePassword()
    {
        return view('change_password');
    }

    public function updatePassword(Request $request)
    {
        $admin= User::first();

        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');

        $admin->password = bcrypt($newPassword);

        $this->validate(
            $request,
            [

                'oldPassword' => ['required',function($attribute, $value, $fails){

                    if(!Hash::check($value,User::first()->password)){
                        return $fails( 'Old password didn\'t match');
                    }
                }],
                'newPassword' => 'required',
                'confirmPassword' => 'same:newPassword',
            ]
        );

        if($admin->save()){
            return redirect('/dashboard');
        }

    }

}
