<?php

namespace App\Http\Controllers;

use App\Asset;
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
            return view('invoice_reports');
        }
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
    }
}
