<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $EquipmentType = EquipmentType::paginate(12);
        return view('backend.equipment.types.index', compact('EquipmentType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.equipment.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'subtitle' => 'string|nullable',
            'description' => 'string|nullable',
            'thumb' => 'nullable'
        ]);

        try {
            // TODO: Implement to store the thumb image
            $type = new EquipmentType($data);
            $type->save();
            return redirect()->route('admin.equipment.types.index')->with('Success', 'EquipmentType was created !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EquipmentType $equipmentType)
    {
        return view('backend.equipment.types.show', compact('equipmentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(EquipmentType $equipmentType)
    {
        return view('backend.equipment.types.edit', compact('equipmentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, EquipmentType $equipmentType)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'subtitle' => 'string|nullable',
            'description' => 'string|nullable',
            'thumb' => 'nullable'
        ]);

        try {
            // TODO: Implement to store/update the thumb image

            $equipmentType->update($data);
            return redirect()->route('admin.equipment.types.index')->with('Success', 'EquipmentType was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(EquipmentType $equipmentType)
    {
        return view('backend.equipment.types.delete', compact('equipmentType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EquipmentType $equipmentType)
    {
        try {
            $equipmentType->delete();
            return redirect()->route('admin.equipment.types.index')->with('Success', 'EquipmentType was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }
}
