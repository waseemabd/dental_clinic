<?php

namespace App\Http\Controllers;

use App\About;
use App\Asset;
use App\Patient_session;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use MongoDB\BSON\Type;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        //
        if ($type == 'expense'){

            $used_Array= [];
            $items = Asset::has('patient_sessions')->get();
//        $items = Asset::with('patient_sessions')->get();
            foreach ($items as $asset){
                $used_amount = 0;
                foreach ($asset->patient_sessions as $used){
                    $used_amount = $used_amount+ $used->pivot->quantity;


                }

                array_push( $used_Array, ['id' => $asset->id, 'amount' => $used_amount]);

            }
//        dd($used_Array);

            return view("expense_reports",compact(['items', 'used_Array']));
        }
        if ($type == 'invoice'){

            $sessions= Patient_session::where('is_done',1)->get();

            return view('invoice_reports',compact('sessions'));
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
        $session= Patient_session::find($id);
        $patient = $session->status->patient;
        $clinic = About::where('role', 'about')->first();
//dd($patient);
        return view('invoice',compact(['session', 'patient', 'clinic']));

    }

    public function download_invoice($id)
    {
//        dd('dasygudhajsd');
        $session= Patient_session::find($id);
        $patient = $session->status->patient->first();
        $clinic = About::where('role', 'about')->first();

        $pdf = app('dompdf.wrapper');
//        $pdf = PDF::loadView('invoice.pdf');
        $pdf->loadView('invoice',compact(['session', 'patient', 'clinic']));
        return $pdf->download('invoice.pdf');

    }



}
