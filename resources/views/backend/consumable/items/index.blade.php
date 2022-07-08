@extends('backend.layouts.app')

@section('title', __('Consumable'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Consumable
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.consumable.items.create')"
                            :text="__('Create Consumable')"></x-utils.link>
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
                            <th>Title</th>
                            {{--                            <th>Product Code<br/>and Brand</th>--}}
                            <th>Category</th>
                            {{--                            <th>Price (LKR)</th>--}}
{{--                            <th>Voltage Rating</th>--}}
                            <th>Form factor</th>
                            <th>Quantity</th>
                            {{--                            <th>Size</th>--}}
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($consumables as $cm)

                            <tr>
                                <td>{{ $cm->title  }}</td>
                                {{--                                <td>{{ $cm->productCode ?? 'N/A' }} ({{ $cm->brand ?? 'N/A' }})</td>--}}

                                <td>
                                    @if($cm->consumable_type() != null)
                                        <a href="{{ route('admin.consumable.types.show', $cm->consumable_type) }}">
                                            {{ $cm->consumable_type['title'] }}
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $cm->formFactor }}</td>
{{--                                <td>{{ $cm->powerRating }}</td>--}}
                                <td>{{ $cm->quantity }}</td>
                                <td>
                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.consumable.items.show', $cm)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ route('admin.consumable.items.edit', $cm)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.consumable.items.delete', $cm)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                                title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    {{ $consumables->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
