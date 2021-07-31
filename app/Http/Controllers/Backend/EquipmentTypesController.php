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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $equipmentTypes = EquipmentTypes::paginate(12);
        return view('backend.equipments.types.index', compact('equipmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.equipments.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $data = request()->validate([
                'title' => 'string|required',
                'subtitle' => 'string|nullable',
                'description' => 'string|nullable',
                'thumb' => 'nullable'
            ]);

            // TODO: Implement to store the thumb image
            $type = new EquipmentTypes($data);
            $type->save();
            return redirect()->route('admin.equipments.types.index')->with('Success', 'EquipmentType was created !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EquipmentTypes $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EquipmentTypes $equipmentType)
    {
        return view('backend.equipments.types.show', compact('equipmentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentTypes $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(EquipmentTypes $equipmentType)
    {
        return view('backend.equipments.types.edit', compact('equipmentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EquipmentTypes $equipmentType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, EquipmentTypes $equipmentType)
    {
        try {
            $data = request()->validate([
                'title' => 'string|required',
                'subtitle' => 'string|nullable',
                'description' => 'string|nullable',
                'thumb' => 'nullable'
            ]);

            // TODO: Implement to store/update the thumb image

            $equipmentType->update($data);
            return redirect()->route('admin.equipments.types.index')->with('Success', 'EquipmentType was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\EquipmentTypes $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(EquipmentTypes $equipmentType)
    {
        return view('backend.equipments.types.delete', compact('equipmentType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EquipmentTypes $equipmentType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EquipmentTypes $equipmentType)
    {
        try {
            $equipmentType->delete();
            return redirect()->route('admin.equipments.types.index')->with('Success', 'EquipmentType was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
        }

    }
}
