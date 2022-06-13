<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequests extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Available status of the job card
    public static function job_status()
    {
        return [
            'PENDING' => 'Pending',
            'WAITING_SUPERVISOR_APPROVAL' => 'Waiting for Supervisor Approval',
            'WAITING_TO_APPROVAL' => 'Waiting for Approval',
            // 'ON_REVISION' => 'On Revision',
            'PENDING_FABRICATION' => 'Pending Fabrication',
            'COMPLETED' => 'Completed'
        ];
    }


    public function machine_info()
    {
        if ($this->machine != null) return $this->belongsTo(Machines::class, 'machine', 'id');
        return null;
    }

    public function material_info()
    {
        if ($this->machine != null) return $this->belongsTo(RawMaterials::class, 'material', 'id');
        return null;
    }

    public function supervisor_info()
    {
        if ($this->supervisor != null) return $this->belongsTo(User::class, 'supervisor', 'id');
        return null;
    }

    public function student_info()
    {
        if ($this->student != null) return $this->belongsTo(User::class, 'student', 'id');
        return null;
    }

    public static function jobsForTechOfficer()
    {
        // Waiting for approval
        $jobs_approval = JobRequests::where('status', 'WAITING_TO_APPROVAL')->get();

        // Pending fabrication
        $jobs_pending = JobRequests::where('status', 'PENDING_FABRICATION')->get();

        // Completed
        // $jobs_completed = JobRequests::where('status', 'COMPLETED')->get();

        return $jobs_approval->merge($jobs_pending);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/jobs/' . $this->thumb;
        return null;
    }

    // Return the relative URL of the thumbnail
    public function fileURL()
    {
        if ($this->file != null) return '/files/jobs/' . $this->file;
        return null;
    }
}
