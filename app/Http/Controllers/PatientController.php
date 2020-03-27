<?php

namespace App\Http\Controllers;


use App\Patient;
use App\Patient_status;
use App\User;
use Illuminate\Http\Request;
use Carbon\Traits\Date;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class PatientController extends Controller
{
    public function __construct(Patient $patients)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $patients = Patient::all();
        return view("patients", compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("add_patient");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $patient = new Patient();
        $user = new User();

        $patient->fname = $request->input('fname');
        $patient->lname = $request->input('lname');
        $patient->userName = $request->input('userName');
        $patient->email = $request->input('email');
        $patient->password = bcrypt($request->input('password')) ;
        $patient->dateOfBirth = $request->input('dateOfBirth');
        $patient->gender = $request->input('gender');
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
//        $patient->image = $request->input('image');
        $patient->is_active = $request->input('status');
//        $patient->created_at = date('Y-m-d H:i:s');

        $user->name = $request->input('userName');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')) ;

            $this->validate(
                $request,
                [
                    'fname' => 'required',
                    'lname' => 'required',
                    'userName' => 'required|unique:patients,userName',
                    'email' => 'email|unique:patients,email',
                    'password' => 'required',
                    'confirmPass' => 'same:password',
                    'phone' => 'numeric',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]
            );

//            dd($request);
            if(isset($request->image)){

                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('images')."/patients", $imageName);
                $patient->image ='/images/patients/'.$imageName;
            }

            if($patient->save()){
                $user->related_patient = $patient->id;
                $user->save();
                return redirect('/patients');
            }




    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Patient $patient)
    {
        //

        $selected_patient = Patient::find($id);

//        dd(  $selected_patient->session()->get());
        $status = $selected_patient->status()->get();
        $session = $selected_patient->session()->get();
        $uncompleted = $selected_patient->session()->where('is_done', 0)->get();
        $details = $selected_patient;
        $statuses = $status;
        $uncompleted = $uncompleted;
        $sessions = $session;
        return view("patient_profile", compact(['details', 'statuses', 'uncompleted', 'sessions', 'id']));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $details = Patient::find($id);
//        dd($details);
        return view("edit_patient", compact('details'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $patient= Patient::find($id);
        $user = User::where('related_patient',$id)->get()->first();

        $patient->fname = $request->input('fname');
        $patient->lname = $request->input('lname');
        $patient->userName = $request->input('userName');
        $patient->email = $request->input('email');
        if($request->input('password') != null ){
            $user->password = bcrypt($request->input('password')) ;
            $patient->password = bcrypt($request->input('password')) ;
        }

        $patient->dateOfBirth = $request->input('dateOfBirth');
        $patient->gender = $request->input('gender');
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
//        $patient->image = $request->input('image');
        $patient->is_active = $request->input('status');



            $this->validate(
                $request,
                [
                    'fname' => 'required',
                    'lname' => 'required',
                    'userName' => 'required',
                    'email' => 'email',
                    'confirmPass' => 'same:password',
                    'phone' => 'numeric',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


                ]
            );

            if(isset($request->image)){

                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('images')."/patients", $imageName);
                $patient->image ='/images/patients/'.$imageName;
            }




            if($patient->save()){
                $user->save();
                return redirect('/patients');
            }






    }


    public function add_status(Request $request, Patient_status $patient_status)
    {


        $status = new Patient_status();

        $status->title = $request->input('title');
        $status->description = $request->input('description');
        $status->notes = $request->input('note');
        $status->expected_sessions_number = $request->input('session_num');
        $status->patient_id = $request->input('patient_id');
        $status->is_active = $request->input('is_active') == 'true' ? 1 : 0;


        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required',
                'note' => 'required',
                'session_num' => 'required|numeric',


            ]
        );

//        $result = $patient_status->insert($data);

        $result = $status->save();
        return $result ? response()->json(['status' => 1, "message" => "status added successfully", 'last_added' => $status]) : response()->json(['status' => 0, "message" => "failed to add status"]);


    }

    public function update_status($id, Request $request, Patient_status $patient_status)
    {

        $this->validate(
            $request,
            [
                'description' => 'required',
                'note' => 'required',
                'session_num' => 'required|numeric',


            ]
        );

        $status = $patient_status->find($id);

        $status->title = ($request->input('title') == "" || $request->input('title') == null) ? "" : $request->input('title');
        $status->description = ($request->input('description') == "" || $request->input('description') == null) ? "" : $request->input('description');
        $status->patient_id = ($request->input('patient_id') == "" || $request->input('patient_id') == null) ? "" : $request->input('patient_id');

        $status->notes = ($request->input('note') == "" || $request->input('note') == null) ? "" : $request->input('note');

        $status->expected_sessions_number = ($request->input('session_num') == "" || $request->input('session_num') == null) ? 0 : $request->input('session_num');

        $status->is_active = $request->input('is_active') == 'true' ? '1' : '0';

        $result = $status->save();

        return $result ? response()->json(['status' => 1, "message" => "updated successfully"]) : response()->json(['status' => 0, "message" => "failed to update"]);

    }

    public function getPatient($id, Patient $patient)
    {

        $result = $patient->find($id);
        $status = $result->status;
//        dd($result);
        return $result ? response()->json(['status' => 1, "message" => "patient founded successfully", 'data' => $result, 'patient_status' => $status]) : response()->json(['status' => 0, "message" => "failed to find patient", 'data' => null, 'patient_status' => null]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Patient::destroy($id) ? response()->json(['status' => 1, "message" => "Patient deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Patient"]);

    }

    public function destroy_status($id)
    {
        //
        return Patient_status::destroy($id) ? response()->json(['status' => 1, "message" => "Status deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Status"]);

    }
}
