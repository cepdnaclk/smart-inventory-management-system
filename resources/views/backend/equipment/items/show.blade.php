@extends('backend.layouts.app')

@section('title', __('Equipment'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment : Show | {{ $equipmentItem->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $equipmentItem->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.equipment.items.edit', $equipmentItem)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.equipment.items.delete', $equipmentItem)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be updated)</td>
                        <td>{{ $equipmentItem->id }}</td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>{{ $equipmentItem->brand }}</td>
                    </tr>
                    <tr>
                        <td>Product Code</td>
                        <td>{{ $equipmentItem->productCode }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{ $equipmentItem->price ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Power Rating</td>
                        <td>
                            @if( $equipmentItem->powerRating != null )
                                {{ $equipmentItem->powerRating." W"}}
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Dimensions (cm) (WxLxH)</td>
                        <td>{{ $equipmentItem->width }} x {{ $equipmentItem->height }} x {{ $equipmentItem->length }}
                            cm
                        </td>
                    </tr>
                    <tr>
                        <td>Weight (g)</td>
                        <td>
                            @if( $equipmentItem->weight != null )
                                {{ $equipmentItem->weight." g"}}
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Specifications</td>
                        <td>{!! str_replace("\n", "<br>", $equipmentItem->specifications) !!}</td>

                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{!! str_replace("\n", "<br>", $equipmentItem->description) !!}</td>
                    </tr>
                    <tr>
                        <td>Usage Instructions</td>
                        <td>{!! str_replace("\n", "<br>", $equipmentItem->instructions) !!}</td>
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $equipmentItem->thumb != null )
                                <img src="{{ $equipmentItem->thumbURL() }}" alt="{{ $equipmentItem->title }}"
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
