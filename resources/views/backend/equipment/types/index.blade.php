@extends('backend.layouts.app')

@section('title', __('Equipment Types'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Types
            </x-slot>

            {{--            @if ($logged_in_user->hasAllAccess())--}}
            <x-slot name="headerActions">
                <x-utils.link
                        icon="c-icon cil-plus"
                        class="card-header-action"
                        :href="route('admin.equipment.types.create')"
                        :text="__('Create Equipment Type')"></x-utils.link>
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

                    <livewire:backend.equipment-type-table/>

{{--                    <div class="container table-responsive pt-3">--}}
{{--                    <table class="table table-striped">--}}
{{--                        <tr>--}}
{{--                            <th>Code</th>--}}
{{--                            <th>Title</th>--}}
{{--                            <th>Parent Category</th>--}}
{{--                            <th>Description</th>--}}
{{--                            <th>&nbsp;</th>--}}
{{--                        </tr>--}}

{{--                        @foreach($equipmentTypes as $equipmentType)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $equipmentType->inventoryCode()  }}</td>--}}
{{--                                <td>{{ $equipmentType->title  }}</td>--}}
{{--                                <td>--}}
{{--                                    @if( $equipmentType->parent() !== null)--}}
{{--                                        <a href="{{ route('admin.equipment.types.show', $equipmentType->parent()->id) }}">--}}
{{--                                            {{ $equipmentType->parent()->title }}--}}
{{--                                        </a>--}}
{{--                                    @else--}}
{{--                                        N/A--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                --}}{{--                                <td>{{ $equipmentType->subtitle ?? 'N/A' }}</td>--}}
{{--                                <td>{{ $equipmentType->description  }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex px-0 mt-0 mb-0">--}}
{{--                                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                            <a href="{{ route('admin.equipment.types.show', $equipmentType)}}"--}}
{{--                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>--}}
{{--                                            </a>--}}

{{--                                            <a href="{{ route('admin.equipment.types.edit', $equipmentType)}}"--}}
{{--                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('admin.equipment.types.delete', $equipmentType)}}"--}}
{{--                                               class="btn btn-danger btn-xs"><i class="fa fa-trash"--}}
{{--                                                                                title="Delete"></i>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                    {{ $equipmentTypes->links() }}--}}
{{--                </div>--}}
            </x-slot>
        </x-backend.card>
    </div>
@endsection
