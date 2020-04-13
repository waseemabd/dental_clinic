<?php

namespace App\Http\Controllers;

use App\asset_patient_session;
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
    public function index()
    {
        $appointments = Patient_session::where('is_done',0)->where('is_active',1)->with('status')->get();
//        dd($appointments);
        return view("appointments",compact('appointments'));
    }

    public function delayRequests()
    {
        $appointments = Patient_session::where('is_done',0)->where('is_active',0)->with('status')->get();
        return view("delay_requests",compact('appointments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=[];
        $patients = Patient::all();
        $payments = Payment_type::all();

        return view("add_appointment",compact(['patients','payments']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $appointment = new Patient_session();

//dd($request->input('payment'));
        $appointment->title = $request->input('title');
        $appointment->description = $request->input('description');
        $appointment->note = $request->input('note');
        $appointment->status_id = $request->input('patient_status');
        $appointment->payment_type_id = $request->input('payment')?$request->input('payment'):null;
        $appointment->date = $request->input('date');
//        dd($request->input('time'));
        $appointment->time = date('H:i:s',strtotime($request->input('time')));
        $appointment->cost = $request->input('cost') ;
        $appointment->price = $request->input('price') ;
        $appointment->is_done = 0;

        $appointment->is_delayed = 0;
//        dd($request->input('status'));
        $appointment->is_active = $request->input('status') ;
        $this->validate(
            $request,
            [
                'title'=> 'required',
                'patient' => 'required',
                'patient_status' => 'required',
                'date' => 'required',
                'time' => 'required',
                'cost' => 'numeric',
                'price' => 'numeric',
            ]
        );


        if($appointment->save()){
            return redirect('/appointments');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $appointment = Patient_session::find($id);
        $selected_statuses = Patient::find($appointment->status->patient->id)->status;
        $patients = Patient::all();
        $payments = Payment_type::all();


        return view('edit_appointment',compact(['patients','payments','appointment','selected_statuses']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


//        $appointment_instance = new Patient_session();
//        $appointment=$appointment_instance->find($id);

        $appointment=Patient_session::find($id);


        $appointment->title = $request->input('title');
        $appointment->description = $request->input('description');
        $appointment->note = $request->input('note');
        $appointment->status_id = $request->input('patient_status');
        $appointment->payment_type_id = $request->input('payment')?$request->input('payment'):null;
        $appointment->date = $request->input('date');
        $appointment->time = date('H:i:s',strtotime($request->input('time')));
        $appointment->cost = $request->input('cost') ;
        $appointment->price = $request->input('price') ;
        $appointment->is_done = $request->input('is_done');

        $appointment->is_delayed = $request->input('is_delayed');
        $appointment->is_active = $request->input('status') ;

        $this->validate(
            $request,
            [
                'title'=> 'required',
                'patient' => 'required',
                'patient_status' => 'required',
                'date' => 'required',
                'time' => 'required',
                'cost' => 'numeric',
                'price' => 'numeric',
            ]
        );


        if($appointment->save()){
            return redirect('/appointments');
        }


    }



    public function getAppointment($id){



        $appointment = Patient_session::find($id);
        $selected_status = $appointment->status;
        $selected_patient = $selected_status->patient;


        return $appointment ? response()->json(['status' => 1, "message" => "fetch info successfully",'appointment'=> $appointment]) : response()->json(['status' => 0, "message" => "failed to fetch info",'appointment'=> null]);

    }

    public function done($id, Request $request){


        $assets_array = $request->input('assets');
        $session = new Patient_session();
        foreach ($assets_array as $assets){
            $used_asset = new asset_patient_session();
            $used_asset->patient_session_id = $id;
            $used_asset->asset_id = $assets['id']['value'];
            $used_asset->quantity = $assets['quantity']['value'];
            $used_asset->save();

        }

        $appointment = Patient_session::find($id);
//        dd($appointment->assets()->pivot());

        $appointment->is_done = 1;

        return $appointment->save() ? response()->json(['status' => 1, "message" => "Appointment has been Done successfully"]) : response()->json(['status' => 0, "message" => "done request failed"]);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Patient_session::destroy($id) ? response()->json(['status' => 1, "message" => "Appointment deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Appointment"]);

    }
}
