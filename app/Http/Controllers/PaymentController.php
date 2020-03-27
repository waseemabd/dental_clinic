<?php

namespace App\Http\Controllers;

use App\Payment_type;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paymentTypes = Payment_type::all();

        return view('payment_types',compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


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
        $type = new Payment_type();

        $type->name = $request->input('name');
        $type->is_active =  $request->input('is_active') == 'on'?true:false;


        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

//        $result = $patient_status->insert($data);

        if($type->save()){
            return redirect('/payment-types');
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
        //
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
        $type =Payment_type::find($id);

        $type->name = $request->input('name');
        $type->is_active = $request->input('is_active') == 'true' ? 1 : 0;


        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

//        $result = $patient_status->insert($data);

//        if($type->save()){
//            return redirect('/payment-types');return redirect('/payment-types');
//        }

            return $type->save() ? response()->json(['status' => 1, "message" => "Payment Type updated successfully"]) : response()->json(['status' => 0, "message" => "failed to update Payment Type"]);


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

        return Payment_type::destroy($id) ? response()->json(['status' => 1, "message" => "Payment deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Payment"]);

    }
}
