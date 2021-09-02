@extends('backend.layouts.app')

@section('title', __('Component Types'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Component Types
            </x-slot>

            {{--            @if ($logged_in_user->hasAllAccess())--}}
            <x-slot name="headerActions">
                <x-utils.link
                        icon="c-icon cil-plus"
                        class="card-header-action"
                        :href="route('admin.component.types.create')"
                        :text="__('Create Component Type')"></x-utils.link>
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
                            <th>Title</th>
                            <th>Parent Category</th>
                            {{-- <th>Subtitle</th> --}}
                            <th>Description</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($componenttypes as $type)
                            <tr>
                                <td>{{ $type->title  }}</td>
                                <td>
                                    @if( $type->parent() !== null)
                                        <a href="{{ route('admin.component.types.show', $type->parent()->id) }}">
                                            {{ $type->parent()->title }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                {{-- <td>{{ $type->subtitle ?? 'N/A' }}</td> --}}
                                <td>{{ $type->description  }}</td>
                                <td>
                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.component.types.show', $type)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ route('admin.component.types.edit', $type)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.component.types.delete', $type)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                                title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    {{ $componenttypes->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
