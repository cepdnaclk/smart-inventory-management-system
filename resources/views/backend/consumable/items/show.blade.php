@extends('backend.layouts.app')

@section('title', __('Consumable'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Consumable : Show | {{ $consumableItem->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $consumableItem->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.consumable.items.edit', $consumableItem)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.consumable.items.delete', $consumableItem)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $consumableItem->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>
                            @if($consumableItem->consumable_type != null)
                                <a href="{{ route('admin.consumable.types.show', $consumableItem->consumable_type) }}">
                                    {{ $consumableItem->consumable_type['title'] }}
                                </a>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            @if($consumableItem->price != null)
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
                        <td>{!! str_replace("\n", "<br>", $consumableItem->specifications) !!}</td>
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $consumableItem->thumb != null )
                                <img src="{{ $consumableItem->thumbURL() }}" alt="{{ $consumableItem->title }}"
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
