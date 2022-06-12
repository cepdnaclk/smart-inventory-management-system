<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\JobRequests;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class JobRequestsController extends Controller
{

    public function index()
    {
        return view('backend.jobs.index');
    }

    public function student_index()
    {
        $jobs = JobRequests::paginate(16);
        return view('backend.jobs.student.index', compact('jobs'));
    }

    public function student_create()
    {
        $machines = Machines::pluck('title', 'id');
        $materials = RawMaterials::pluck('title', 'id');
        $lecturers = []; //User::lecturers();

        foreach (User::lecturers() as $l) {
            $lecturers[$l->id] = $l->name;
        }

        return view('backend.jobs.student.create', compact('machines', 'materials', 'lecturers'));
    }

    public function student_store(Request $request)
    {
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
                $data['file'] = $this->uploadFile(null, $request->file, "jobs");
            }

            $jobReq = new JobRequests($data);
            $jobReq->status = 'PENDING';
            $jobReq->requested_time = date("Y-m-d h:i:s"); // 2022-05-12 12:17:17
            $jobReq->student = $request->user()->id;
            $jobReq->save();

            return redirect()->route('admin.jobs.student.confirm', $jobReq);
        } catch (\Exception $ex) {
//            dd($ex);
            return abort(500);
        }
    }

    public function student_show(JobRequests $jobRequests)
    {
        return view('backend.jobs.student.show', compact('jobRequests'));
    }

    public function student_confirm(JobRequests $jobRequests)
    {
        if ($jobRequests->status == 'PENDING') {
            return view('backend.jobs.student.confirm', compact('jobRequests'));
        } else {
            $id = $jobRequests->id;
            return redirect()->route('admin.jobs.student.index')->with('Success', 'The fabrication request #' . $id . ' already sent for the approval !');
        }
    }

    public function student_summary(JobRequests $jobRequests)
    {
        try {
            // Email to supervisor
            // TODO: Implement this

            // Change the status
            $jobRequests->status = 'WAITING_SUPERVISOR_APPROVAL';
            $jobRequests->save();
            $id = $jobRequests->id;
            return redirect()->route('admin.jobs.student.index')->with('Success', 'The fabrication request #' . $id . ' was placed successfully !');

        } catch (\Exception $ex) {
            dd($ex);
            return abort(500);
        }
    }

    public function student_delete(JobRequests $jobRequests)
    {
        return view('backend.jobs.student.delete', compact('jobRequests'));
    }

    public function student_destroy(JobRequests $jobRequests)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteFile($jobRequests->thumbURL());
            $this->deleteFile($jobRequests->fileURL());

            $jobRequests->delete();
            return redirect()->route('admin.jobs.student.index')->with('Success', 'Job request was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function supervisor_index()
    {
        $jobs = JobRequests::where('supervisor', \Auth::user()->id)->get();
        return view('backend.jobs.supervisor.index', compact('jobs'));
    }

    public function supervisor_store(Request $request)
    {
        dd($request);
    }

    public function officer_store(Request $request)
    {
        dd($request);
    }

    public function supervisor_show(JobRequestsController $jobRequests)
    {
        return view('backend.jobs.supervisor.show');
    }


    public function techOfficer_index()
    {
        $jobs = JobRequests::jobsForTechOfficer();
        return view('backend.jobs.technical-officer.index', compact('jobs'));
    }


    public function techOfficer_show(JobRequestsController $jobRequests)
    {
        return view('backend.jobs.technical-officer.show');
    }



    // Support Functions
    private function deleteFile($currentURL)
    {
        if ($currentURL != null) {
            $file = public_path($currentURL);
            if (File::exists($file)) {
                unlink($file);
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
        $newFile->move(public_path('files/' . $folder), $fileName);
        return $fileName;
    }
}