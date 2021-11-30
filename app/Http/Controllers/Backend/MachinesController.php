<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Machines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class MachinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $machines = Machines::all()->paginate(16);
        return view('backend.machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
         return view('backend.machines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'code' => 'string|nullable|max:8',
            'title' => 'string|required',

        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "machines");
            }

            $machine = new Machines($data);

            $machine->save();
            return redirect()->route('admin.machines.index')->with('Success', 'Machine was created !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Machines  $machines
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Machines $machines)
    {
        return view('backend.machines.show', compact('machines'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Machines  $machines
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Machines $machines)
    {
        return view('backend.machines.edit', compact('machines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Machines  $machines
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|void
     */
    public function update(Request $request, Machines $machines)
    {
        $data = request()->validate([
            'code' => 'string|nullable|max:8',
            'title' => 'string|required',

        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($machines->thumbURL(), $request->thumb, "machines");
            }
            $machines->update($data);
            return redirect()->route('admin.machines.index')->with('Success', 'Machine was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     * @param \App\Models\Machines $machines
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Machines $machines)
    {
        return view('backend.machines.delete', compact('rawMaterials'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Machines $machines
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(Machines $machines)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($machines->thumbURL());

            $machines->delete();
            return redirect()->route('admin.machines.index')->with('Success', 'Machine was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    private function deleteThumb($currentURL)
    {
        if ($currentURL != null) {
            $oldImage = public_path($currentURL);
            if (File::exists($oldImage)) unlink($oldImage);
        }
    }

    // Private function to handle thumb images
    private function uploadThumb($currentURL, $newImage, $folder)
    {
        // Delete the existing image
        $this->deleteThumb($currentURL);

        $imageName = time() . '.' . $newImage->extension();
        $newImage->move(public_path('img/' . $folder), $imageName);
        $imagePath = "/img/$folder/" . $imageName;
        $image = Image::make(public_path($imagePath))->fit(360, 360);
        $image->save();

        return $imageName;
    }
}
