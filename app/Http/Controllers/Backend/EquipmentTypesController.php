<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentTypes;
use Illuminate\Http\Request;

class EquipmentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentTypes = EquipmentTypes::paginate(12);
        return view('backend.equipments.types.index', compact('equipmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.equipments.types.create');
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
     * @param  \App\Models\EquipmentTypes  $equipmentTypes
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentTypes $equipmentType)
    {
        return view('backend.equipments.types.show', compact('equipmentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentTypes  $equipmentTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentTypes $equipmentType)
    {
//        dd($equipmentTypes);
        return view('backend.equipments.types.edit', compact('equipmentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentTypes  $equipmentTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentTypes $equipmentTypes)
    {
        //
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param  \App\Models\EquipmentTypes  $equipmentTypes
     * @return \Illuminate\Http\Response
     */
    public function delete(EquipmentTypes $equipmentType)
    {
        return view('backend.equipments.types.delete', compact('equipmentType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentTypes  $equipmentTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentTypes $equipmentTypes)
    {
        //
    }
}
