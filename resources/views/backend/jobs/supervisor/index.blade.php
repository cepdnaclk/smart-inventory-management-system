@extends('backend.layouts.app')

@section('title', __('Job Requests - Supervisor View'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests - Supervisor View
            </x-slot>

            <x-slot name="body">
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="container table-responsive pt-3">
                    <h4 class="pb-3">Waiting for Supervisor Approval</h4>
                    <livewire:backend.fabrications-waiting-for-supervisor-approval-table/>
                    {{--                    <table class="table table-striped align-middle">--}}
                    {{--                        <tr>--}}
                    {{--                            <th>ID</th>--}}
                    {{--                            <th>Status</th>--}}
                    {{--                            <th>Machine</th>--}}
                    {{--                            <th>Material</th>--}}
                    {{--                            <th>Student</th>--}}
                    {{--                            <th>&nbsp;</th>--}}
                    {{--                        </tr>--}}

                    {{--                        @foreach($jobs as $job)--}}
                    {{--                            @if($job->status == 'WAITING_SUPERVISOR_APPROVAL')--}}
                    {{--                                <tr>--}}
                    {{--                                    <td>Job #{{ $job->id }}</td>--}}
                    {{--                                    <td>{{ \App\Models\JobRequests::job_status()[$job->status]  }}</td>--}}
                    {{--                                    <td>--}}
                    {{--                                        @if($job->machine_info() != null)--}}
                    {{--                                            <a href="{{ route('admin.machines.show', $job->machine) }}" target="_blank">--}}
                    {{--                                                {{ $job->machine_info['title'] }}--}}
                    {{--                                            </a>--}}
                    {{--                                        @endif--}}
                    {{--                                    </td>--}}
                    {{--                                    <td>--}}
                    {{--                                        @if($job->material_info() != null)--}}
                    {{--                                            <a href="{{ route('admin.raw_materials.show', $job->material) }}"--}}
                    {{--                                               target="_blank">--}}
                    {{--                                                {{ $job->material_info['title'] }}--}}
                    {{--                                            </a>--}}
                    {{--                                        @endif--}}
                    {{--                                    </td>--}}
                    {{--                                    <td>--}}
                    {{--                                        @if($job->student_info() != null)--}}
                    {{--                                            {{ $job->student_info['name'] }}--}}
                    {{--                                        @endif--}}
                    {{--                                    </td>--}}

                    {{--                                    <td class="d-flex justify-content-end">--}}
                    {{--                                        <div class="btn-group" role="group">--}}
                    {{--                                            <a href="{{ route('admin.jobs.supervisor.show', $job)}}"--}}
                    {{--                                               class="btn btn-primary btn-xs">--}}
                    {{--                                                <i class="fa fa-check" title="Approval"></i>--}}
                    {{--                                            </a>--}}
                    {{--                                        </div>--}}
                    {{--                                    </td>--}}

                    {{--                                </tr>--}}
                    {{--                            @endif--}}
                    {{--                        @endforeach--}}
                    {{--                    </table>--}}

                </div>


                <div class="container table-responsive pt-5">
                    <h4 class="pb-3">Pending Fabrication</h4>
                    <table class="table table-striped align-middle">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Machine</th>
                            <th>Material</th>
                            <th>Student</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($jobs as $job)
                            @if($job->status == 'PENDING_FABRICATION')
                                <tr>
                                    <td>Job #{{ $job->id }}</td>
                                    <td>{{ \App\Models\JobRequests::job_status()[$job->status]  }}</td>
                                    <td>
                                        @if($job->machine_info() != null)
                                            <a href="{{ route('admin.machines.show', $job->machine) }}" target="_blank">
                                                {{ $job->machine_info['title'] }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->material_info() != null)
                                            <a href="{{ route('admin.raw_materials.show', $job->material) }}"
                                               target="_blank">
                                                {{ $job->material_info['title'] }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($job->student_info() != null)
                                            {{ $job->student_info['name'] }}
                                        @endif
                                    </td>

                                    <td class="d-flex justify-content-end">
                                        &nbsp;
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
