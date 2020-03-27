<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Asset_patient_session;
use App\Patient_session;
use App\patient_session_asset;
use App\Used_asset;
use Illuminate\Http\Request;

class UsedItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view("used_items",compact(['items', 'used_Array']));

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
        $used_Array= [];
        $item= Asset::find($id);
////        $items = Asset::with('patient_sessions')->get();
//
//            foreach ($item->patient_sessions as $used){
////                $used_amount = $used_amount+ $used->pivot->quantity;
//
//
//            }
//
////            array_push( $used_Array, ['id' => $asset->id, 'amount' => $used_amount]);

        return view("view_used_items",compact('item'));



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
