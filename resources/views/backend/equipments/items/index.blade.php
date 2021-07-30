@extends('backend.layouts.app')

@section('title', __('Equipments'))

@section('breadcrumb-links')
    @include('backend.equipments.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipments
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.equipments.items.create')"
                            :text="__('Create Equipment')"></x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                <div class="container table-responsive pt-3">
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Brand</th>
                            <th>Width</th>
                            <th>Length</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($equipments as $eq)
                            <tr>
                                <td>{{ $eq->title  }}</td>
                                <td>{{ $eq->brand }}</td>
                                <td>{{ $eq->width }}</td>
                                <td>{{ $eq->height }}</td>
                                <td>{{ $eq->length }}</td>
                                <td>{{ $eq->weight }}</td>

                                <td>
                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.equipments.items.show', $eq)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ route('admin.equipments.items.edit', $eq)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.equipments.items.delete', $eq)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                                title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    {{ $equipments->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
