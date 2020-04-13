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

        $id = $request->input('patientId');
//        dd($id);

        $selected_patient = Patient::find($id);

        if($selected_patient){
            //        dd(  $selected_patient->session()->get());
            $statuses = $selected_patient->status()->get() ;
            $sessions = $selected_patient->session()->get();
            $uncompleted = $selected_patient->session()->where('is_done', 0)->get();
            $completed = $selected_patient->session()->where('is_done', 1)->get();


            // response
//        dd('fdsfsdf');
//        return view("patient_profile", compact(['details', 'statuses', 'uncompleted', 'sessions', 'id']));
//            return $this->apiResponse(compact(['selected_patient', 'statuses', 'uncompleted', 'sessions', 'id']));
            return $this->apiResponse(compact(['selected_patient', 'statuses', 'uncompleted', 'sessions']),200 );
        }else{
            return $this->apiResponse(null,404,'Patient Not Found');
        }


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
        $id = $request->input('patientId');
        $patient= Patient::find($id);
        $user = User::where('related_patient',$id)->get()->first();
        if($patient) {
            $patient->fname = $request->input('fname');
            $patient->lname = $request->input('lname');
            $patient->email = $request->input('email');


            $patient->dateOfBirth = $request->input('dateOfBirth');
            $patient->gender = $request->input('gender') == "Male" ? "M" : "F";
            $patient->address = $request->input('address');
            $patient->phone = $request->input('phone');
        }else{
            return $this->apiResponse(null,404,'Patient Not Found');

        }
        if($user) {
            $user->email = $request->input('email');
        }else{
            return $this->apiResponse(null,404,'User Not Found');
        }


       $validator = $this->validate(
            $request,
            [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'email',
                'phone' => 'numeric',
//                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


            ]
        );




//            if(isset($request->image)){
//
//                $imageName = time().'.'.$request->image->getClientOriginalExtension();
//                $request->image->move(public_path('images')."/patients", $imageName);
//                $patient->image ='/images/patients/'.$imageName;
//            }




            if($patient->save()){
                $user->save();

                return $this->apiResponse($patient, 200 );
            }else{
                return $this->apiResponse(null,406, 'Patient Could Not Updated' );
            }






    }


    public function getStatus(Request $request){
        $id = $request->input('patientId');
        $selected_patient = Patient::find($id);

//        dd(  $selected_patient->session()->get());
        if($selected_patient){
            $status = $selected_patient->status()->get();
        }else{
            return $this->apiResponse(null,404, 'Patient Not Found' );
        }

        if($status){
            return $this->apiResponse($status, 200 );
        }else{
            return $this->apiResponse(null,404, 'No Status Found' );
        }

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
