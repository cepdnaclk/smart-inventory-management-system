@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Fabrications : Show | Job #{{ $jobRequests->id  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Job #{{ $jobRequests->id }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.jobs.student.delete', $jobRequests)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Status</td>
                        <td><b>{{ \App\Models\JobRequests::job_status()[$jobRequests->status] }}</b></td>
                    </tr>

                    <tr>
                        <td>Source File</td>
                        <td>
                            <span>
                                <i class="fa fa-2x fa-file-archive-o" aria-hidden="true"></i>
                                <a href="{{ $jobRequests->fileURL() }}">
                                    {{ $jobRequests->file }}
                                </a>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>{!! str_replace("\n", "<br>", $jobRequests->student_notes ) !!}</td>
                    </tr>

                    @if($jobRequests->other_notes != null)
                    <tr>
                        <td>Notes</td>
                        <td>
                            <div class="pt-2">
                                <u>Other notes:</u><br>
                                <em class="p-2">
                                    {!! str_replace("\n", "<br>", $jobRequests->other_notes) !!}
                                </em>
                            </div>
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td>Supervisor</td>
                        <td>
                            @if($jobRequests->supervisor_info() != null)
                                {{ $jobRequests->supervisor_info['name'] }}
                                ( {{ $jobRequests->supervisor_info['email'] }} )
                            @endif

                            @if($jobRequests->supervisor_notes != null)
                            <div class="pt-2">
                                <u>Notes by supervisor:</u><br>
                                <em class="p-2">
                                    {!! str_replace("\n", "<br>", $jobRequests->supervisor_notes) !!}
                                </em>
                            </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Machine</td>
                        <td>
                            @if($jobRequests->machine_info() != null)
                                @if( $jobRequests->machine_info['thumb'] != null )
                                    <img style="width: 120px;"
                                        src="{{ $jobRequests->machine_info->thumbURL() }}"
                                        alt="{{ $jobRequests->machine_info['title'] }}" class="img">
                                @endif

                                <a href="{{ route('admin.machines.show', $jobRequests->machine) }}" target="_blank">
                                    {{ $jobRequests->machine_info['title'] }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Material</td>
                        <td>
                            @if($jobRequests->material_info() != null)
                                @if( $jobRequests->material_info['thumb'] != null )
                                    <img style="width: 120px;"
                                        src="{{ $jobRequests->material_info->thumbURL() }}"
                                        alt="{{ $jobRequests->material_info['title'] }}" class="img">
                                @endif
                                <a href="{{ route('admin.raw_materials.show', $jobRequests->material) }}" target="_blank">
                                    {{ $jobRequests->material_info['title'] }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Material Usage</td>
                        <td>
                            @if( $jobRequests->material_usage != null )
                            {{ $jobRequests->material_usage }}
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Job Requested at</td>
                        @if( $jobRequests->requested_time != null )
                        <td>{{ $jobRequests->requested_time }}</td>
                        @else
                        <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Job Approved at</td>
                        @if( $jobRequests->approved_time != null )
                        <td>{{ $jobRequests->approved_time }}</td>
                        @else
                        <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Job Scheduled at</td>
                        @if( $jobRequests->scheduled_time != null )
                        <td>{{ $jobRequests->scheduled_time }}</td>
                        @else
                        <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Job Completed at</td>
                        @if( $jobRequests->completed_time != null )
                        <td>{{ $jobRequests->completed_time }}</td>
                        @else
                        <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $jobRequests->thumb != null )
                                <img src="{{ $jobRequests->thumbURL() }}" class="img img-thumbnail">
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>



                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
