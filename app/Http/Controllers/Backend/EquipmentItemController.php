<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentItem;
use Illuminate\Http\Request;

class EquipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = EquipmentItem::paginate(12);
        return view('backend.equipments.items.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.equipments.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentItem $equipmentItem)
    {
        return view('backend.equipments.items.show', compact('equipmentItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentItem $equipmentItem)
    {
        return view('backend.equipments.items.edit', compact('equipmentItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentItem $equipmentItem)
    {
        //
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param  \App\Models\EquipmentItem  $equipmentItem
     * @return \Illuminate\Http\Response
     */
    public function delete(EquipmentItem $equipmentItem)
    {
        return view('backend.equipments.items.delete', compact('equipmentItem'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentItem $equipmentItem)
    {
        //
    }
}
