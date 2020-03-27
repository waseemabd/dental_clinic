<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Patient;
use App\Patient_status;
use App\Supplier;
use Illuminate\Http\Request;

class AssetController extends Controller
{

    public function __construct(Asset $assets)
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $assets = Asset::with('supplier')->get();

        if($request->isMethod('post')){

            return $assets ? response()->json(['status' => 1, "message" => "fetch info successfully",'assets'=> $assets]) : response()->json(['status' => 0, "message" => "failed to fetch info",'assets'=> null]);

        }


        return view('assets',compact('assets'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $suppliers = Supplier::all();

        return view('add_asset',compact('suppliers'));

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
        $asset = new Asset();

        $asset->name = $request->input('name');
        $asset->description = $request->input('description') ;
        $asset->price = $request->input('price') ;
        $asset->quantity = $request->input('quantity') ;
        $asset->supplier_id = $request->input('supplier') ;
        $asset->movement_date = $request->input('date') ;
        $asset->is_active = $request->input('status') ;

        $this->validate(
            $request,
            [
                'name' => 'required',
                'quantity' => 'required',
                'supplier' => 'required',
                'price' => 'numeric',
            ]
        );


        if($asset->save()){
            return redirect('/assets');
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
        $asset = Asset::find($id);
        $suppliers = Supplier::all();

        return view('edit_asset',compact(['asset', 'suppliers']));



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


        $asset = Asset::find($id);
        $asset->name = $request->input('name');
        $asset->description = $request->input('description') ;
        $asset->price = $request->input('price') ;
        $asset->quantity = $request->input('quantity') ;
        $asset->supplier_id = $request->input('supplier') ;
        $asset->movement_date = $request->input('date') ;
        $asset->is_active = $request->input('status') ;

        $this->validate(
            $request,
            [
                'name' => 'required',
                'quantity' => 'required',
                'supplier' => 'required',
                'price' => 'numeric',
            ]
        );


        if($asset->save()){
            return redirect('/assets');
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
        return Asset::destroy($id) ? response()->json(['status' => 1, "message" => "Asset deleted successfully"]) : response()->json(['status' => 0, "message" => "failed to delete Asset"]);


    }
}
