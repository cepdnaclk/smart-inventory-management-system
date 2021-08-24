@extends('frontend.layouts.app')

@section('title', __('Terms & Conditions'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Item: {{ $equipmentItem->title }}</h3>


                <table class="table">
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            @if( $equipmentItem->thumb != null )
                                <img src="{{ $equipmentItem->thumbURL() }}" alt="{{ $equipmentItem->title }}"
                                     class="img img-thumbnail">
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $equipmentItem->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>
                            @if($equipmentItem->equipment_type() != null)
                                <a href="{{ route('frontend.equipment.category', $equipmentItem->equipment_type) }}">
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
                </table>
            </div>
        </div>
    </div>
@endsection
