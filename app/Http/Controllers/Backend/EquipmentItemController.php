<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $equipment = EquipmentItem::paginate(12);
        return view('backend.equipment.items.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = EquipmentType::pluck('title', 'id');
        return view('backend.equipment.items.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'brand' => 'string|nullable',
            'equipment_type_id' => 'numeric|required',

            'specifications' => 'string|nullable',
            'description' => 'string|nullable',
            'instructions' => 'string|nullable',

            // 'isElectrical' => 'accepted',
            'powerRating' => 'numeric|nullable',
            'price' => 'numeric|nullable',

            'width' => 'numeric|nullable',
            'length' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'weight' => 'numeric|nullable',

            'thumb' => 'nullable'
        ]);

        try {
            // TODO: Implement to store the thumb image

            $type = new EquipmentItem($data);
            $type->save();
            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was created !');

        } catch (\Exception $ex) {
            dd($ex);
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EquipmentItem $equipmentItem)
    {
        return view('backend.equipment.items.show', compact('equipmentItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(EquipmentItem $equipmentItem)
    {
        $types = EquipmentType::pluck('title', 'id');
        return view('backend.equipment.items.edit', compact('types', 'equipmentItem'));
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
        $data = request()->validate([
            'title' => 'string|required',
            'brand' => 'string|nullable',
            'equipment_type_id' => 'numeric|required',

            'specifications' => 'string|nullable',
            'description' => 'string|nullable',
            'instructions' => 'string|nullable',

            // 'isElectrical' => 'accepted',
            'powerRating' => 'numeric|nullable',
            'price' => 'numeric|nullable',

            'width' => 'numeric|nullable',
            'length' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'weight' => 'numeric|nullable',

            'thumb' => 'nullable'
        ]);

        try {
            // TODO: Implement to store the thumb image

            $equipmentItem->update($data);
            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was updated !');

        } catch (\Exception $ex) {
            dd($ex);
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(EquipmentItem $equipmentItem)
    {
        return view('backend.equipment.items.delete', compact('equipmentItem'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function destroy(EquipmentItem $equipmentItem)
    {
        try {
            $equipmentItem->delete();
            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }
}
