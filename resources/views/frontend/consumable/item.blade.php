@extends('frontend.layouts.app')

@section('title', ($consumableItem->title))

@push('after-styles')
    <style>
        td {
            padding: 1px 12px 1px 0;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12 d-flex mb-4">
                @if( $consumableItem->thumb != null )
                    <img src="{{ $consumableItem->thumbURL() }}"
                         alt="{{ $consumableItem->title }}"
                         class="img img-thumbnail img-fluid p-3 mx-auto">
                @else
                    {{-- TODO: Add a default image --}}
                    <span>[Not Available]</span>
                @endif

            </div>
            <div class="col-md-8 col-sm-12 col-12 mb-4">
                <h3>{{ $consumableItem->title }} <br>
                    <small class="text-muted">
                        {{ $consumableItem->inventoryCode() }}
                        <hr>
                    </small>
                </h3>

                <div>
                    <table>
                        <tr>
                            <td>Category</td>
                            <td>
                                : @if($consumableItem->consumable_type->parent() != null)
                                    <a href="{{ route('frontend.consumable.category', $consumableItem->consumable_type->parent() ) }}">
                                        {{ $consumableItem->consumable_type->parent()->title }}
                                    </a> &gt;
                                @endif

                                <a href="{{ route('frontend.consumable.category', $consumableItem->consumable_type) }}">
                                    {{ $consumableItem->consumable_type['title'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Product Code</td>
                            <td>
                                : <b>{{ $consumableItem->productCode }}({{ $consumableItem->brand }})</b>
                            </td>
                        </tr>

                        <tr>
                            <td>Available Quantity</td>
                            <td>
                                : <b>{{ $consumableItem->quantity }}</b>
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Dimensions</td>--}}
{{--                            <td>--}}
{{--                                : <b>--}}
{{--                                    @if( $consumableItem->width!=0 && $consumableItem->height!=0 && $consumableItem->length!=0)--}}
{{--                                        {{ $consumableItem->width }} x {{ $consumableItem->height }}--}}
{{--                                        x {{ $consumableItem->length }} cm <br>--}}
{{--                                    @else--}}
{{--                                        <span>[Not Available]</span> <br>--}}
{{--                                    @endif--}}
{{--                                </b>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td>Weight</td>
                            <td>
                                : <b>
                                    @if( $consumableItem->weight != null )
                                        {{ $consumableItem->weight." g"}}
                                    @else
                                        <span>[Not Available]</span>
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Datasheet URL</td>
                            <td>
                                : <b>
                                    @if( $consumableItem->datasheetUrl != null )
                                        <a href="{{ $consumableItem->datasheetUrl }}" target="_blank">
                                            {{ $consumableItem->datasheetUrl }}
                                    @else
                                        <span>[Not Available]</span>
                                    @endif
                            </td>
                        </tr>
                    </table>
                </div>

                @if($consumableItem->powerRating != null)
                    <div class="pt-3">
                        Power Rating: {{ $consumableItem->powerRating}}
                    </div>
                @endif

                @if ($consumableItem->formFactor != null)
                    <div class="pt-3">
                        Form Factor: {{ $consumableItem->formFactor}}
                    </div>
                @endif

                @if ($consumableItem->voltageRating != null)
                    <div class="pt-3">
                        Voltage Rating: {{ $consumableItem->voltageRating}}
                    </div>
                @endif

                @if ($consumableItem->price != null)
                    <div class="pt-3">
                        Price: {{ "Rs. " . $consumableItem->price }}
                    </div>
                @endif

                @if($consumableItem->description !== null)
                    <div class="pt-3">
                        <u>Description</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $consumableItem->description) !!}
                        </div>
                    </div>
                @endif

                @if($consumableItem->specifications !== null)
                    <div class="pt-3">
                        <u>Specifications</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $consumableItem->specifications) !!}
                        </div>
                    </div>
                @endif


                @if($consumableItem->instructions !== null)
                    <div class="pt-3">
                        <u>Usage Instructions</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $consumableItem->instructions) !!}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection