<?php

namespace App\Http\Controllers\Admin;

use App\WholeSaleUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WholeSaleUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage wholesale units']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = WholeSaleUnit::all();
        return view('admin.wholesaleunit.index',compact('units'));
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
        WholeSaleUnit::create(['unit'=>$request->input('unit')]);
        return redirect()->route('wholesaleunits.index')->with('success','A New Wholesale Unit has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WholeSaleUnit  $wholeSaleUnit
     * @return \Illuminate\Http\Response
     */
    public function show(WholeSaleUnit $wholeSaleUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WholeSaleUnit  $wholeSaleUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(WholeSaleUnit $wholeSaleUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WholeSaleUnit  $wholeSaleUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WholeSaleUnit $wholeSaleUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WholeSaleUnit  $wholeSaleUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, WholeSaleUnit $wholeSaleUnit)
    {
        WholeSaleUnit::findOrFail($request->input('unit'))->delete();
        return redirect()->route('wholesaleunits.index')->with('success','Wholesale Unit has been Removed');
    }
}
