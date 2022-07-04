@extends('backend.layouts.app')

@section('title', __('Equipment'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.equipment.items.create')"
                            :text="__('Create Equipment')"></x-utils.link>
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
                            <th>Code</th>
                            <th>Title</th>
                            <th>Product Code<br/>and Brand</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Price (LKR)</th>
                            <th>Dimensions(cm)<br/>W x L x H</th>
                            <th>Weight (g)</th>
                            <th>&nbsp;</th>
                        </tr>
                        
                        @foreach($equipment as $eq)
                            <tr>
                                <td>{{ $eq->inventoryCode()  }}</td>
                                <td>{{ $eq->title  }}</td>
                                <td>{{ $eq->productCode ?? 'N/A' }} ({{ $eq->brand ?? 'N/A' }})</td>
                                <td>{{ $eq->quantity }}</td>
                                <td>
                                    @if($eq->equipment_type() != null)
                                        <a href="{{ route('admin.equipment.types.show', $eq->equipment_type) }}">
                                            {{ $eq->equipment_type['title'] }}
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $eq->price }}</td>
                                <td>{{ $eq->width }} x {{ $eq->height }} x {{ $eq->length }}</td>
                                <td>{{ $eq->weight }}</td>

                                <td>
                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.equipment.items.show', $eq)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ route('admin.equipment.items.edit', $eq)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.equipment.items.delete', $eq)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                                title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    {{ $equipment->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
