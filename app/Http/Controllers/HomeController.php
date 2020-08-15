<?php

namespace App\Http\Controllers;

use App\About;
use App\Patient;
use App\Patient_session;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;

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


//    public function patientsNumber(){
//        $patients = Patient::where('is_active',1)->get('created_at');
//        dd($patients);
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $patient_count = Patient::all()->count();
        $pending_count = $appointments = Patient_session::where('is_done',0)->where('is_active',0)->count();
        $upcoming = Patient_session::where('is_done',0)->where('is_active',1)->with('status')->orderBy('date', 'desc')->take(5)->get();
        $new_patients = Patient::where('is_active',1)->orderBy('created_at', 'desc')->take(5)->get();


//        $patients = Patient::where('is_active',1)->get('created_at');
//        dd($patients);


//                dd($upcoming);
        return view('dashboard',compact(['patient_count','pending_count','upcoming','new_patients']));
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
//        $profile->is_active = $request->input('status') ;
        $profile->is_active = 1 ;

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





    public function patientsNumber(){

        $thisYearNumber = Patient::whereYear('created_at', Carbon::now()->year)
            ->select(DB::raw("MONTH(created_at) month"), DB::raw("count(id) as number"))
            ->groupby("month")
        ->get();

        $previousYearNumber = Patient::whereYear('created_at', Carbon::now()->year-1)
            ->select(DB::raw("MONTH(created_at) month"), DB::raw("count(id) as number"))
            ->groupby("month")
            ->get();

        $thisYearArr = [];
        $previousYearArr =[];
        foreach ($thisYearNumber as $raw){
            $thisYearArr[$raw['month']] = $raw['number'];

        }
        foreach ($previousYearNumber as $raw){
            $previousYearArr[$raw['month']] = $raw['number'];

        }
        return $thisYearNumber || $previousYearNumber  ? response()->json(['status' => 1, "message" => "patient founded successfully",'thisYear' => Carbon::now()->year ,'patientNumber' => $thisYearArr,'previousYear' => Carbon::now()->year-1, 'previousNumber' => $previousYearArr]) : response()->json(['status' => 0, "message" => "failed to find patient", 'patientNumber' => null, 'previousNumber' => null]);

    }


    public function sessionsNumber(){
        $uncompleted = Patient_session::whereYear('date', Carbon::now()->year)
            ->select(DB::raw("MONTH(date) month"), DB::raw("count(id) as number"))
            ->where('is_done',0)
            ->groupby("month")
            ->get();
        $completed = Patient_session::whereYear('date', Carbon::now()->year)
            ->select(DB::raw("MONTH(date) month"), DB::raw("count(id) as number"))
            ->where('is_done',1)
            ->groupby("month")
            ->get();

        $sessionArr = [];
        $appointmentArr =[];
        foreach ($completed as $raw){
            $sessionArr[$raw['month']] = $raw['number'];

        }
        foreach ($uncompleted as $raw){
            $appointmentArr[$raw['month']] = $raw['number'];

        }
        return $completed || $uncompleted  ? response()->json(['status' => 1, "message" => "patient founded successfully",'sessionsNumber' => $sessionArr, 'appointmentsNumber' => $appointmentArr]) : response()->json(['status' => 0, "message" => "failed to find patient", 'sessionsNumber' => null, 'appointmentsNumber' => null]);


    }


    public function profit(){

        $session= Patient_session::whereYear('date', Carbon::now()->year)
            ->select(DB::raw("MONTH(date) month"), DB::raw("sum(price) - sum(cost) as profit"))
            ->where('is_done',1)
            ->groupby("month")
            ->get();

        $profitArr =[];
        foreach ($session as $raw){
            $profitArr[$raw['month']] = $raw['profit'];

        }
//dd($profitArr);
        return $session   ? response()->json(['status' => 1, "message" => "patient founded successfully",'profit' => $profitArr]) : response()->json(['status' => 0, "message" => "failed to find patient", 'profit' => null]);


    }


    public function generatePass(){
        return  bcrypt('123');
    }


}
