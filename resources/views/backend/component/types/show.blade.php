@extends('backend.layouts.app')

@section('title', __('Component Types'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Component Types : Show {{ $componentType->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $componentType->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.component.types.edit', $componentType)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.component.types.delete', $componentType)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $componentType->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Parent Category</td>
                        <td>
                            @if( $componentType->parent() !== null)
                                <a href="{{ route('admin.equipment.types.show', $componentType->parent()->id) }}">
                                    {{ $componentType->parent()->title }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Subtitle</td>
                        <td>{{ $componentType->subtitle }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $componentType->description }}</td>
                    </tr>
                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $componentType->thumb != null )
                                <img src="{{ $componentType->thumbURL() }}" alt="{{ $componentType->title }}"
                                     class="img img-thumbnail">
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
