<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobRequests;
use Illuminate\Http\Request;

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
        //
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
}
