@extends('backend.layouts.app')

@section('title', __('Locker Details'))

@section('breadcrumb-links')
@endsection

@section('content')
<div>
    <x-backend.card>
        <x-slot name="header">
            Locker Details
        </x-slot>

        {{--            @if ($logged_in_user->hasAllAccess())--}}
        <x-slot name="headerActions">
            <x-utils.link
            icon="c-icon cil-plus"
            class="card-header-action"
            :href="route('admin.locker.details.create')"
            :text="__('Create Locker Detail')"></x-utils.link>
        </x-slot>
        {{--            @endif--}}

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
                        <th>Locker Id</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>&nbsp;</th>
                    </tr>

                    @foreach($lockers as $locker)
                    <tr>
                        <td>{{ $locker->id }}</td>
                        <td>
                            @if( $locker->is_available == 0)
                                <h4><span class="badge badge-sm bg-gradient-secondary">Not<br>Available</span></h4>
                            @else
                                <h4><span class="badge badge-sm bg-gradient-success">Available</span></h4>
                            @endif
                        </td>
                        <td>{{ $locker->notes }}</td>
                        <td>
                            <div class="d-flex px-0 mt-0 mb-0">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin.locker.details.show', $locker)}}"
                                        class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                    </a>

                                    <a href="{{ route('admin.locker.details.edit', $locker)}}"
                                        class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                    </a>

                                    <a href="{{ route('admin.locker.details.delete', $locker)}}"
                                        class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                    </a>
                                </div>
                            </div>
                        </td>

        </tr>
        @endforeach
    </table>
    
    {{ $lockers->links() }}

</div>
</x-slot>
</x-backend.card>
</div>
@endsection
