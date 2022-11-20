<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Locker;

class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lockers = Locker::with('orders')->get();
        try {
            return response()->json($lockers, 200);
        } catch (\Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     $Locker_id = Locker::getNextLockerId();
    //     return view('backend.locker.details.create', compact('Locker_id'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $data = request()->validate([
    //         'notes' => 'string|nullable',
    //         'is_available' => 'nullable|boolean',
    //     ]);

    //     try {

    //         $locker = new Locker($data);

    //         // Update checkbox condition
    //         $locker->is_available = $request->input('is_available') ? true : false;

    //         $locker->save();
    //         return redirect()->route('admin.locker.details.index')->with('Success', 'locker was created !');
    //     } catch (\Exception $ex) {
    //         return abort(500);
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  Locker $lockerDetail
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Locker $lockerDetail)
    // {
    //     return view('backend.locker.details.show', compact("lockerDetail"));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Locker $lockerDetail)
    // {
    //     return view('backend.locker.details.edit', compact('lockerDetail'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Locker $lockerDetail)
    // {
    //     $data = request()->validate([
    //         // 'order_id' => 'numeric|nullable',

    //         'notes' => 'string|nullable',

    //         'is_available' => 'nullable|boolean',
    //     ]);
    //     try {

    //         // Update checkbox condition
    //         $lockerDetail->is_available = $request->input('is_available') ? true : false;

    //         $lockerDetail->update($data);
    //         return redirect()->route('admin.locker.details.index')->with('Success', 'locker was updated !');
    //     } catch (\Exception $ex) {
    //         return abort(500);
    //     }
    // }

    // /**
    //  * Confirm to delete the specified resource from storage.
    //  *
    //  */
    // public function delete(Locker $lockerDetail)
    // {
    //     return view('backend.locker.details.delete', compact('lockerDetail'));
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Locker $lockerDetail)
    // {
    //     try {

    //         $lockerDetail->delete();
    //         return redirect()->route('admin.locker.details.index')->with('Success', 'locker was deleted !');
    //     } catch (\Exception $ex) {
    //         return abort(500);
    //     }
    // }
}
