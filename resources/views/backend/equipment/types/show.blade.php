@extends('backend.layouts.app')

@section('title', __('Equipment Types'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Types : Show {{ $equipmentType->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $equipmentType->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.equipment.types.edit', $equipmentType)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.equipment.types.delete', $equipmentType)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $equipmentType->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Parent Category</td>
                        <td>
                            @if( $equipmentType->parent() !== null)
                                <a href="{{ route('admin.equipment.types.show', $equipmentType->parent()->id) }}">
                                    {{ $equipmentType->parent()->title }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Subtitle</td>
                        <td>{{ $equipmentType->subtitle }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $equipmentType->description }}</td>
                    </tr>
                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $equipmentType->thumb != null )
                                <img src="{{ $equipmentType->thumbURL() }}" alt="{{ $equipmentType->title }}"
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
