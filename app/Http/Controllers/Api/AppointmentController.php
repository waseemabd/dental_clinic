<?php

namespace App\Http\Controllers\Api;

use App\asset_patient_session;
use App\Http\Controllers\Controller;
use App\Patient;
use App\patient_session_asset;
use App\Patient_status;
use App\Patient_session;
use App\Payment_type;
use App\Used_asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{


    use ApiResponseTrait;



    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)   // appointmentsHistory
    {
        $id = $request->input('patientId');
        $selected_patient = Patient::find($id);
//        $uncompleted = $selected_patient->session()->where('is_done', 0)->get();
//        if($selected_patient){
//
//        }else{
//            return $this->apiResponse(null,404,'Patient Not Found');
//        }
        if($selected_patient){
            $completed = $selected_patient->session()->where('is_done', 1)->with('status')->get();
        }else{
            return $this->apiResponse(null,404,'Patient Not Found');
        }

        //response
        return $this->apiResponse($completed, 200 );
    }

    public function appointments(Request $request)
    {
        $id = $request->input('patientId');

        $selected_patient = Patient::find($id);


        if($selected_patient){
            $uncompleted = $selected_patient->session()->where('is_done', 0)->with('status')->get();
        }else{
            return $this->apiResponse(null,404,'Patient Not Found');
        }

        //response
        return $this->apiResponse($uncompleted, 200 );

    }

//    public function getAppointmentByStatus(Request $request)
//    {
//        $id = $request->input('statusId');
//
//        $selected_status = Patient::find($id);
//
//        if($selected_status){
//            $uncompleted = $selected_status->session()->where('is_done', 0)->get();
//            $completed = $selected_status->session()->where('is_done', 1)->get();
//        }else{
//            return $this->apiResponse(null,404,'Patient Not Found');
//        }
//
//        //response
//        return $this->apiResponse(compact(['completed','uncompleted']), 200 );
//
//
//        //response
////        return view("appointments",compact('appointments'));
//    }


    public function delayRequest(Request $request)
    {
        $id = $request->input('sessionId');
        $appointment = Patient_session::find($id);

        if($appointment){

            $appointment->is_active = 0;
            $appointment->is_delayed = 1;

        }else{
            return $this->apiResponse(null,404,'Appointment Not Found');
        }


        if($appointment->save()){
            return $this->apiResponse($appointment, 200 );
        }else{
            return $this->apiResponse(null,406,'Appointment Not Found');
        }

    }



    public function getAppointment($id){



        $appointment = Patient_session::find($id);
        $selected_status = $appointment->status;
        $selected_patient = $selected_status->patient;


        return $appointment ? response()->json(['status' => 1, "message" => "fetch info successfully",'appointment'=> $appointment]) : response()->json(['status' => 0, "message" => "failed to fetch info",'appointment'=> null]);

    }



    public function delay($id, Request $request){
        $appointment = Patient_session::find($id);
        $appointment->date = $request->input('date');
//        dd(date('H:i:s',strtotime($request->input('time'))));
        $appointment->time = date('H:i:s',strtotime($request->input('time')));
        $appointment->is_delayed = 1;
        $appointment->is_active = 1;

        return $appointment->save() ? response()->json(['status' => 1, "message" => "Appointment has been Delayed successfully"]) : response()->json(['status' => 0, "message" => "delay request failed"]);

    }

}
