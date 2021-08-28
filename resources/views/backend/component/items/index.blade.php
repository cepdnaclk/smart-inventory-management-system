@extends('backend.layouts.app')

@section('title', __('Component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Component
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.component.items.create')"
                            :text="__('Create Component')"></x-utils.link>
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
                            <th>Product Code<br/>and Brand</th>
                            <th>Category</th>
                            {{-- <th>Price (LKR)</th>--}}
                            <th>Size</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($components as $cm)

                            <tr>
                                <td>{{ $cm->title  }}</td>
                                <td>{{ $cm->productCode ?? 'N/A' }} ({{ $cm->brand ?? 'N/A' }})</td>

                                <td>
                                    @if($cm->component_type() != null)
                                        <a href="{{ route('admin.component.types.show', $cm->component_type) }}">
                                            {{ $cm->component_type['title'] }}
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $cm->size }}</td>

                                <td>
                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.component.items.show', $cm)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ route('admin.component.items.edit', $cm)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.component.items.delete', $cm)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                                title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    {{ $components->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
