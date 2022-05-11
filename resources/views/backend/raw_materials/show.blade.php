@extends('backend.layouts.app')

@section('title', __('Raw Materials'))

@section('breadcrumb-links')
    @include('backend.raw_materials.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Raw Materials : Show | {{ $rawMaterials->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $rawMaterials->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.raw_materials.edit', $rawMaterials)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.raw_materials.delete', $rawMaterials)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $rawMaterials->inventoryCode() }}</td>
                    </tr>

                    <tr>
                        <td>Color</td>
                        <td>{{ ($rawMaterials->color) ? $rawMaterials->color : "N/A" }}
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{ $rawMaterials->quantity }} {{ $rawMaterials->unit }}
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>{!! str_replace("\n", "<br>", $rawMaterials->description) !!}</td>
                    </tr>

                    <tr>
                        <td>Specifications</td>
                        <td>{!! str_replace("\n", "<br>", $rawMaterials->specifications) !!}</td>
                    </tr>

                    <tr>
                        <td>Availability</td>
                        <td>{{ \App\Models\RawMaterials::availabilityOptions()[$rawMaterials->availability] }}</td>
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $rawMaterials->thumb != null )
                                <img src="{{ $rawMaterials->thumbURL() }}" alt="{{ $rawMaterials->title }}"
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
