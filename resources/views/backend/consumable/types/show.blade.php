@extends('backend.layouts.app')

@section('title', __('Component Types'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Consumable Types : Show {{ $consumableType->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $consumableType->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.consumable.types.edit', $consumableType)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.consumable.types.delete', $consumableType)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $consumableType->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Parent Category</td>
                        <td>
                            @if( $consumableType->parent() !== null)
                                <a href="{{ route('admin.component.types.show', $consumableType->parent()->id) }}">
                                    {{ $consumableType->parent()->title }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Subtitle</td>
                        <td>{{ $consumableType->subtitle }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $consumableType->description }}</td>
                    </tr>
                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $consumableType->thumb != null  && $consumableType->thumb != "")
                                <img src="{{ $consumableType->thumbURL() }}" alt="{{ $consumableType->title }}"
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
