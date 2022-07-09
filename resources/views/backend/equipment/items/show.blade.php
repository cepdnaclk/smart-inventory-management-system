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
                            <a href="{{ route('admin.equipment.items.edit.location', $equipmentItem)}}"
                               class="btn btn-warning btn-xs"><i class="fa fa-map-marker" title="Edit Location"></i>
                            <a href="{{ route('admin.equipment.items.delete', $equipmentItem)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $equipmentItem->inventoryCode() }}</td>
                    </tr>


                    @if(count($locations_array) > 0)
                        @foreach($locations_array as $eachLocation)
                            <tr>
                                <td>Location {{$loop->index + 1}}</td>
                                <td>{{ $eachLocation }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Location</td>
                            <td>Not Available</td>
                        </tr>
                    @endif

                    <tr>
                        <td>Type</td>
                        <td>
                            @if($equipmentItem->equipment_type() != null)
                                <a href="{{ route('admin.equipment.types.show', $equipmentItem->equipment_type) }}">
                                    {{ $equipmentItem->equipment_type['title'] }}
                                </a>
                            @endif
                        </td>
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
                        <td>
                            @if($equipmentItem->price != null)
                                Rs. {{ $equipmentItem->price }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{ $equipmentItem->quantity }}</td>
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
