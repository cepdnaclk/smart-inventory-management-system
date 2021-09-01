@extends('backend.layouts.app')

@section('title', __('Component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Component : Show | {{ $componentItem->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $componentItem->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.component.items.edit', $componentItem)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.component.items.delete', $componentItem)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $componentItem->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>
                            @if($componentItem->component_type() != null)
                                <a href="{{ route('admin.component.types.show', $componentItem->component_type) }}">
                                    {{ $componentItem->component_type['title'] }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>{{ $componentItem->brand }}</td>
                    </tr>
                    <tr>
                        <td>Product Code</td>
                        <td>{{ $componentItem->productCode }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            @if($componentItem->price != null)
                                Rs. {{ $componentItem->price }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity </td>
                        <td>{{ $componentItem->quantity }} 
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Size </td>
                        <td>{{ $componentItem->size }} 
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>{!! str_replace("\n", "<br>", $componentItem->description) !!}</td>
                    </tr>
                    <tr>
                        <td>Usage Instructions</td>
                        <td>{!! str_replace("\n", "<br>", $componentItem->instructions) !!}</td>
                    </tr>
                    <tr>
                        <td>Is It Available ? </td>
                        <td>
                            {{ @if($componentItem->size)
                                        <span>YES</span>
                                @else 
                                    <span class="text-danger">NO</span>
                            }} 
                        </td>
                    </tr>
                    <tr>
                        <td>Is It Electrical? ? </td>
                        <td>
                            {{ @if($componentItem->size)
                                        <span>YES</span>
                                @else 
                                    <span class="text-danger">NO</span>
                            }} 
                        </td>
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $componentItem->thumb != null )
                                <img src="{{ $componentItem->thumbURL() }}" alt="{{ $componentItem->title }}"
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
