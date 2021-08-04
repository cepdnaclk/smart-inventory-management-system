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
                <table class="table">
                    <tr>
                        <td>Code (to be updated)</td>
                        <td>{{ $equipmentItem->id }}</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $equipmentItem->title }}</td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>{{ $equipmentItem->brand }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{ $equipmentItem->price ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Power Rating</td>
                        <td>{{ $equipmentItem->powerRating." W"  ?? 'N/A'  }}</td>
                    </tr>
                    <tr>
                        <td>Dimensions (WxLxH) in cm</td>
                        <td>{{ $equipmentItem->width }} x {{ $equipmentItem->height }} x {{ $equipmentItem->length }}
                            cm
                        </td>
                    </tr>
                    <tr>
                        <td>Weight (g)</td>
                        <td>{{ $equipmentItem->weight }} g</td>
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
            </x-slot>
        </x-backend.card>
    </div>
@endsection
