@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
<div>
    <x-backend.card>
        <x-slot name="header">
            Raw Materails
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                        icon="c-icon cil-plus"
                        class="card-header-action"
                        :href="route('admin.jobs.student.create')"
                        :text="__('Create Fabrication Request')"></x-utils.link>
            </x-slot>
        @endif

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
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Machine</th>
                        <th>Material</th>
                        <th>Supervisor</th>
                        <th>&nbsp;</th>
                    </tr>

                    @foreach($jobs as $job)

                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>
                                @if($job->machine_info() != null)
                                <a href="{{ route('admin.machines.show', $job->machine) }}" target="_blank">
                                    {{ $job->machine_info['title'] }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($job->material_info() != null)
                                <a href="{{ route('admin.raw_materials.show', $job->material) }}" target="_blank">
                                    {{ $job->material_info['title'] }}
                                </a>
                                @endif
                            </td>
                            <td>
                            @if($job->supervisor_info() != null)
                                {{ $job->supervisor_info['name'] }}
                            @endif
                            </td>
                            <td>
                                <div class="d-flex px-0 mt-0 mb-0">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.jobs.student.show', $job)}}"
                                           class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.student.delete', $job)}}"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </table>

                {{ $jobs->links() }}
            </div>
        </x-slot>
    </x-backend.card>
</div>
@endsection
