@extends('backend.layouts.app')

@section('title', __('Orders'))

@section('breadcrumb-links')
    @include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Order : Show | {{ $order->user->name  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $order->user->name }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.orders.edit', $order)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.orders.delete', $order)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    
                    <tr>
                        <td>Details</td>
                        <td>
                            @if($order->componentItems != null)
                                @foreach ($order->componentItems as $item)
                                <td>
                                    <a href="{{ route('admin.orders.show', $item->title) }}">
                                        {{  $item->title }}
                                    </a>
                                </td>
                                <td>
                                    {{  $item->pivot->quantity }}
                                </td>
                                @endforeach
                                
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Picked up date</td>
                        <td>{{ $order->picked_data }}</td>
                    </tr>
                    <tr>
                        <td>Due date to return</td>
                        <td>{{ $order->due_date_to_return }}</td>
                    </tr>
                    <tr>
                        <td>Returned date</td>
                        <td>
                            {{$order->returned_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>status </td>
                        <td>{{ $order->status }} 
                        </td>
                    </tr>
                    
                    
                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
