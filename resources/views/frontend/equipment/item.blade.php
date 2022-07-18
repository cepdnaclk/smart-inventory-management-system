@extends('frontend.layouts.app')

@section('title', ($equipmentItem->title))

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
                @if( $equipmentItem->thumbURL() != null )
                    <img src="{{ $equipmentItem->thumbURL() }}"
                         alt="{{ $equipmentItem->title }}"
                         class="img img-thumbnail img-fluid p-3 mx-auto">
                @else
                    {{-- TODO: Add a default image --}}
                    <span>[Not Available]</span>
                @endif

            </div>
            <div class="col-md-8 col-sm-12 col-12 mb-4">

                <div class="container pb-2 d-inline-flex">
                    <div class="col-10">
                        <h3>{{ $equipmentItem->title }} <br>
                            <small class="text-muted">
                                {{ $equipmentItem->inventoryCode() }}
                                <hr>
                            </small>
                        </h3>
                    </div>
                    <div class="col-2">
                        @if ($logged_in_user!= null && ($logged_in_user->isAdmin() || $logged_in_user->isLecturer() || $logged_in_user->isTechOfficer() || $logged_in_user->isMaintainer()))
                            <a target="_blank" href="{{ route('admin.equipment.items.edit', $equipmentItem)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div>
                    <table>
                        <tr>
                            <td>Category</td>
                            <td>
                                : @if($equipmentItem->equipment_type->parent_id() != null)
                                    <a href="{{ route('frontend.equipment.category', $equipmentItem->equipment_type->parent()->first() ) }}">
                                        {{ $equipmentItem->equipment_type->parent()->first()->title }}
                                    </a> &gt;
                                @endif

                                <a href="{{ route('frontend.equipment.category', $equipmentItem->equipment_type) }}">
                                    {{ $equipmentItem->equipment_type['title'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Product Code</td>
                            <td>
                                : <b>{{ $equipmentItem->productCode }}({{ $equipmentItem->brand }})</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Available Quantity</td>
                            <td>
                                : <b>{{ $equipmentItem->quantity }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Dimensions</td>
                            <td>
                                : <b>
                                    @if( $equipmentItem->width!=0 && $equipmentItem->height!=0 && $equipmentItem->length!=0)
                                        {{ $equipmentItem->width }} x {{ $equipmentItem->height }}
                                        x {{ $equipmentItem->length }} cm <br>
                                    @else
                                        <span>[Not Available]</span> <br>
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>
                                : <b>
                                    @if( $equipmentItem->weight != null )
                                        {{ $equipmentItem->weight." g"}}
                                    @else
                                        <span>[Not Available]</span>
                                    @endif
                                </b>
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- Location info --}}
                @if($locationCount > 1)
                    <div class="pt-3">
                        <u>Locations</u>
                        <ul>
                            @foreach($locationStringArray as $eachLocation)
                                <li>{{$eachLocation}}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif ($locationCount == 1)
                    <div class="pt-3">
                        <u>Location</u>
                        <ul>
                            <li>{{$locationStringArray[0]}}</li>
                        </ul>
                    </div>
                @endif

                @if($equipmentItem->isElectrical && $equipmentItem->powerRating != null)
                    <div class="pt-3">
                        Power Rating: {{ $equipmentItem->powerRating." W"}}
                    </div>
                @endif

                @if($equipmentItem->description !== null && $equipmentItem->description !== "")
                    <div class="pt-3">
                        <u>Description</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $equipmentItem->description) !!}
                        </div>
                    </div>
                @endif

                @if($equipmentItem->specifications !== null && $equipmentItem->specifications !== "")
                    <div class="pt-3">
                        <u>Specifications</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $equipmentItem->specifications) !!}
                        </div>
                    </div>
                @endif


                @if($equipmentItem->instructions !== null && $equipmentItem->instructions !== "")
                    <div class="pt-3">
                        <u>Usage Instructions</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $equipmentItem->instructions) !!}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
