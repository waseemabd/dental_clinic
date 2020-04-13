<?php

namespace App\Http\Controllers;

use App\About;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('auth')->except('generatePass');
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


    public function viewProfile(Request $request)
    {

        $name= Auth::user()->name;
        $profile =About::where('role','profile')->where('is_active', 1);
        $detail = $profile->first() ? $profile->first() : new About();

//dd($profile->first() );
        return view('profile', compact(['name','detail']));
    }

    public function edit_profile(){

        $profile =About::where('role','profile')->where('is_active', 1);
        $detail = $profile->first() ? $profile->first() : new About();
        return view('edit_profile', compact('detail'));
    }

    public function update_profile(Request $request){

        $profile = About::where('role','profile')->where('is_active', 1)->first() ? About::where('role','profile')->where('is_active', 1)->first() : new About();
//        dd(! About::where('role','profile')->where('is_active', 1)->first());


        $profile->role = 'profile';
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->address = $request->input('address');

//        $about->image = $request->input('image');
        $profile->is_active = $request->input('status') ;

        $this->validate(
            $request,
            [

                'phone' => 'numeric',

                'email' => 'email',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if(isset($request->image)){

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images')."/about", $imageName);
            $profile->image ='/images/about/'.$imageName;
        }

        if($profile->save()){
            return redirect('/myProfile');
        }

    }

    public function changePassword()
    {
        return view('change_password');
    }

    public function updatePassword(Request $request)
    {
        $admin= User::first(); /** TODO **/

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






    public function generatePass(){
        return  bcrypt('123');
    }


}
