@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Fabrications : Confirm | Job #{{ $jobRequests->id  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Job #{{ $jobRequests->id }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.jobs.student.summary', $jobRequests)}}"
                               class="btn btn-primary btn-xs me-2"><i class="fa fa-check" title="Approve"></i>
                               Confirm and Email to supervisor
                            </a>

                            <a href="{{ route('admin.jobs.student.delete', $jobRequests)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
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

                    <tr>
                        <td>Supervisor</td>
                        <td>
                            @if($jobRequests->supervisor_info() != null)
                                {{ $jobRequests->supervisor_info['name'] }}
                                ( {{ $jobRequests->supervisor_info['email'] }} )
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
