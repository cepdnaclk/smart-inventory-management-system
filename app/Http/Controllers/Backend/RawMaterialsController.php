<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RawMaterials;
use Illuminate\Http\Request;

class RawMaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.raw_materials.index');
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
     * @param  \App\Models\RawMaterials  $rawMaterials
     * @return \Illuminate\Http\Response
     */
    public function show(RawMaterials $rawMaterials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RawMaterials  $rawMaterials
     * @return \Illuminate\Http\Response
     */
    public function edit(RawMaterials $rawMaterials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RawMaterials  $rawMaterials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RawMaterials $rawMaterials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RawMaterials  $rawMaterials
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawMaterials $rawMaterials)
    {
        //
    }
}
