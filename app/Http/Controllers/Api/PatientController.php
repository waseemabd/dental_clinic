<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Patient;
use App\Patient_status;
use App\User;
use Illuminate\Http\Request;
use Carbon\Traits\Date;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class PatientController extends Controller
{


    use ApiResponseTrait;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

        $id = $request->input('id');
//        dd($id);

        $selected_patient = Patient::find($id);

//        dd(  $selected_patient->session()->get());
        $status = $selected_patient->status()->get();
        $session = $selected_patient->session()->get();
        $uncompleted = $selected_patient->session()->where('is_done', 0)->get();
        $completed = $selected_patient->session()->where('is_done', 1)->get();
        $details = $selected_patient;
        $statuses = $status;
        $uncompleted = $uncompleted;
        $sessions = $session;

        // response
//        dd('fdsfsdf');
//        return view("patient_profile", compact(['details', 'statuses', 'uncompleted', 'sessions', 'id']));
        return $this->apiResponse($selected_patient);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $request->input('id');
        $patient= Patient::find($id);
        $user = User::where('related_patient',$id)->get()->first();

        $patient->fname = $request->input('fname');
        $patient->lname = $request->input('lname');
        $patient->email = $request->input('email');


        $patient->dateOfBirth = $request->input('dateOfBirth');
        $patient->gender = $request->input('gender');
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');

        $this->validate(
            $request,
            [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'email',
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

                // response
//                return redirect('/patients');
            }






    }


    public function getStatus($id){

        $selected_patient = Patient::find($id);

//        dd(  $selected_patient->session()->get());
        $status = $selected_patient->status()->get();

        //response

    }


//    public function getPatient($id, Patient $patient)
//    {
//
//        $result = $patient->find($id);
//        $status = $result->status;
////        dd($result);
//        return $result ? response()->json(['status' => 1, "message" => "patient founded successfully", 'data' => $result, 'patient_status' => $status]) : response()->json(['status' => 0, "message" => "failed to find patient", 'data' => null, 'patient_status' => null]);
//
//    }

}
