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




    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index($id)   // appointmentsHistory
    {

        $selected_patient = Patient::find($id);
//        $uncompleted = $selected_patient->session()->where('is_done', 0)->get();
        $completed = $selected_patient->session()->where('is_done', 1)->with('status')->get();
        //response
//        return view("appointments",compact('appointments'));
    }

    public function appointments($id)
    {
        $selected_patient = Patient::find($id);
        $uncompleted = $selected_patient->session()->where('is_done', 0)->with('status')->get();
//        $completed = $selected_patient->session()->where('is_done', 1)->with('status')->get();
        //response
//        return view("appointments",compact('appointments'));
    }

    public function getAppointmentByStatus($id)
    {
        $selected_patient = Patient::find($id);
        $uncompleted = $selected_patient->status()->where('id', $id)->session()->get();
//        $completed = $selected_patient->session()->where('is_done', 1)->with('status')->get();
        //response
//        return view("appointments",compact('appointments'));
    }


    public function delayRequest(Request $request)
    {
        $status_id = $request->input('id');
        $appointments = Patient_session::where('status_id',$status_id)->get();
        $appointments->is_delayed = 1;
        if($appointments->save()){
            //response
        }
//        return view("delay_requests",compact('appointments'));
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
