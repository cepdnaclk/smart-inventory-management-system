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
                @if( $consumableItem->thumbURL() != null )
                    <img src="{{ $consumableItem->thumbURL() }}"
                         alt="{{ $consumableItem->title }}"
                         class="img img-thumbnail img-fluid p-3 mx-auto">
                @else
                    {{-- TODO: Add a default image --}}
                    <span>[Not Available]</span>
                @endif

            </div>
            <div class="col-md-8 col-sm-12 col-12 mb-4">
                <div class="container pb-2 d-inline-flex">
                    <div class="col-10">
                        <h3>{{ $consumableItem->title }} <br>
                            <small class="text-muted">
                                {{ $consumableItem->inventoryCode() }}
                                <hr>
                            </small>
                        </h3>
                    </div>
                    <div class="col-2">
                        @if ($logged_in_user!= null && ($logged_in_user->isAdmin() || $logged_in_user->isLecturer() || $logged_in_user->isTechOfficer() || $logged_in_user->isMaintainer()))
                            <a target="_blank" href="{{ route('admin.consumable.items.edit', $consumableItem)}}"
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
                            <td>Available Quantity</td>
                            <td>
                                : <b>
                                    @if($consumableItem->quantity==0)
                                        Out of Stock
                                    @else
                                        {{ $consumableItem->quantity }}
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

                        @if ($consumableItem->formFactor != null)
                            <tr>
                                <td>Form Factor</td>
                                <td>: {{ $consumableItem->formFactor}}</td>
                            </tr>
                        @endif

                        @if ($consumableItem->price != null)
                            <tr>
                                <td>Price</td>
                                <td>: {{ "Rs. " . sprintf("%0.2f", $consumableItem->price) }}</td>
                            </tr>
                        @endif
                    </table>
                </div>

                @if($consumableItem->description !== null)
                    <div class="pt-3">
                        <u>Description</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $consumableItem->description) !!}
                        </div>
                    </div>
                @endif

                @if($consumableItem->specifications !== null && $consumableItem->specifications !== "")
                    <div class="pt-3">
                        <u>Specifications</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $consumableItem->specifications) !!}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection