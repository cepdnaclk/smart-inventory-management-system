<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\JobRequests;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class JobRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $machines = Machines::pluck('title', 'id');
        $materials = RawMaterials::pluck('title', 'id');
        $lecturers = []; //User::lecturers();

        foreach (User::lecturers() as $l) {
            $lecturers[$l->id] = $l->name;
        }
//        dd($machines);

        return view('backend.jobs.create', compact('machines', 'materials', 'lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $data = request()->validate([
            'machine' => 'numeric|required',
            'material' => 'numeric|required',
            'supervisor' => 'numeric|required',
            'student_notes' => 'string|required',
            'file' => 'required|required|mimes:zip|max:51200',
            'thumb' => 'image|required|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadImage(null, $request->thumb, "jobs");
            }
            if ($request->file != null) {
                $data['file'] = $this->uploadFile(null, $request->file, "jobs/file");
            }

            $jobReq = new JobRequests($data);
            $jobReq->status = 'WAITING_SUPERVISOR_APPROVAL';
            $jobReq->requested_time = date("Y-m-d h:i:s"); // 2022-05-12 12:17:17
            $jobReq->student = $request->user()->id;
            $jobReq->save();

            return redirect()->route('admin.jobs.index')->with('Success', 'A new job request was placed successfully !');
        } catch (\Exception $ex) {
            dd($ex);

            return abort(500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function supervisor_store(Request $request)
    {
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function techo_store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\JobRequests $jobRequests
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function supervisor_show(JobRequestsController $jobRequests)
    {
        // return view('backend.jobs.supervisor.show', compact('jobRequests'));
        return view('backend.jobs.supervisor.show');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\JobRequests $jobRequests
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function techo_show(JobRequestsController $jobRequests)
    {
        // return view('backend.jobs.supervisor.show', compact('jobRequests'));
        return view('backend.jobs.technical-officer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\JobRequests $jobRequests
     * @return \Illuminate\Http\Response
     */
    public function edit(JobRequests $jobRequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\JobRequests $jobRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobRequests $jobRequests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\JobRequests $jobRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobRequests $jobRequests)
    {
        //
    }


    private function deleteFile($currentURL)
    {
        if ($currentURL != null) {
            $oldImage = public_path($currentURL);
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
        }
    }

    // Private function to handle thumb images
    private function uploadImage($currentURL, $newImage, $folder)
    {
        // Delete the existing image
        $this->deleteFile($currentURL);

        $imageName = time() . '.' . $newImage->extension();
        $newImage->move(public_path('img/' . $folder), $imageName);
        $imagePath = "/img/$folder/" . $imageName;
        $image = Image::make(public_path($imagePath))->fit(360, 360);
        $image->save();

        return $imageName;
    }

    // Private function to handle file upload
    private function uploadFile($currentURL, $newFile, $folder)
    {
        // Delete the existing file
        $this->deleteFile($currentURL);

        $fileName = time() . '.' . $newFile->extension();
        // $newFile->move(public_path($folder), $fileName);
        $newFile->storeAs("uploads/" . $folder, $fileName);

        return $fileName;
    }
}
