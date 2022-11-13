@extends('backend.layouts.app')

@section('title', __('Consumable'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Consumable : Show | {{ $consumableItem->title }}
            </x-slot>

            <x-slot name="body">
                <div class="d-inline-flex container pb-2">
                    <div class="d-flex">
                        <h4>{{ $consumableItem->title }}</h4>
                    </div>
                    <div class="d-flex mt-0 mb-0 ml-auto px-0">
                        <div
                            class="btn-group"
                            role="group"
                            aria-label="Modify Buttons"
                        >
                            <a
                                href="{{ route('admin.consumable.items.edit', $consumableItem) }}"
                                class="btn btn-info btn-xs"
                            ><i
                                    class="fa fa-pencil"
                                    title="Edit"
                                ></i>
                            </a>
                            <a
                                href="{{ route('admin.consumable.items.edit.location', $consumableItem) }}"
                                class="btn btn-warning btn-xs"
                            ><i
                                    class="fa fa-map-marker"
                                    title="Edit Location"
                                ></i>
                            </a>
                            <a
                                href="{{ route('admin.consumable.items.delete', $consumableItem) }}"
                                class="btn btn-danger btn-xs"
                            ><i
                                    class="fa fa-trash"
                                    title="Delete"
                                ></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $consumableItem->inventoryCode() }}</td>
                    </tr>

                    @if (count($locations_array) > 0)
                        <tr>
                            <td>Locations</td>
                            <td>
                                @foreach ($locations_array as $eachLocation)
                                    {{ $eachLocation }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>Location</td>
                            <td>Not Available</td>
                        </tr>
                    @endif

                    <tr>
                        <td>Type</td>
                        <td>
                            @if ($consumableItem->consumable_type != null)
                                <a href="{{ route('admin.consumable.types.show', $consumableItem->consumable_type) }}">
                                    {{ $consumableItem->consumable_type['title'] }}
                                </a>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            @if ($consumableItem->price != null)
                                Rs. {{ $consumableItem->price }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{ $consumableItem->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <td>Form factor</td>
                        <td>{{ $consumableItem->formFactor }}
                        </td>
                    </tr>

                    <tr>
                        <td>Specification</td>
                        <td>{!! str_replace("\n", '<br>', $consumableItem->specifications) !!}</td>
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if ($consumableItem->thumb != null)
                                <img
                                    src="{{ $consumableItem->thumbURL() }}"
                                    alt="{{ $consumableItem->title }}"
                                    class="img img-thumbnail"
                                >
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
