<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::all();


        return view('suppliers',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('add_supplier');
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

        $supplier = new Supplier();

        $supplier->name = $request->input('name');
        $supplier->company = $request->input('company') ;
        $supplier->email = $request->input('email') ;
        $supplier->phone = $request->input('phone') ;
        $supplier->address = $request->input('address') ;
        $supplier->is_active = $request->input('status') ;

        $this->validate(
            $request,
            [
                'name' => 'required',
                'company' => 'required',
                'email' => 'required|email',
                'phone' => 'numeric',
            ]
        );


        if($supplier->save()){
            return redirect('/suppliers');
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
        $supplier = Supplier::find($id);

        return view('edit_supplier',compact( 'supplier'));
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

        $supplier = Supplier::find($id);

        $supplier->name = $request->input('name');
        $supplier->company = $request->input('company') ;
        $supplier->email = $request->input('email') ;
        $supplier->phone = $request->input('phone') ;
        $supplier->address = $request->input('address') ;
        $supplier->is_active = $request->input('status') ;

        $this->validate(
            $request,
            [
                'name' => 'required',
                'company' => 'required',
                'email' => 'required|email',
                'phone' => 'numeric',
            ]
        );


        if($supplier->save()){
            return redirect('/suppliers');
        }
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
        return Supplier::destroy($id) ? response()->json(['status' => 1, "message" => "Supplier deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Supplier"]);


    }
}
