@extends('backend.layouts.app')

@section('title', __('Order Requests - Technical Officer View'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Order Request by
                    <b>{{ $approvedOrder->user['name'] }}</b>
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Order #{{ $approvedOrder->id }}</h4>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Status</td>
                        <td><b>{{ $approvedOrder->status}}</b></td>
                    </tr>

                    <tr>
                        <td>
                            Components
                        </td>
                        <td>
                            @foreach($approvedOrder->componentItems as $componentItem)
                                    <a href="{{ route('admin.component.items.show', $componentItem) }}">
                                        {{ $componentItem->title }}
                                    </a>
                                    @if($componentItem->pivot_quantity == null)
                                        - 0
                                    @else
                                        - {{ $componentItem ->pivot_quantity }}
                                    @endif
                                    <br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Approved Lecture</td>
                        <td>
                            @if($approvedOrder->orderApprovals != null)
                                {{ $approvedOrder->orderApprovals->lecturer_id['name'] }}
                                ( {{ $approvedOrder->orderApprovals->lecturer_id['email'] }} )
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Order Requested at</td>
                        @if( $approvedOrder->ordered_date != null )
                            <td>{{ $approvedOrder->ordered_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Picked at</td>
                        @if( $approvedOrder->picked_date != null )
                            <td>{{ $approvedOrder->picked_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Due Date</td>
                        @if( $approvedOrder->due_date_to_return != null )
                            <td>{{ $approvedOrder->due_date_to_return }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Returned at</td>
                        @if( $approvedOrder->returned_date != null )
                            <td>{{ $approvedOrder->returned_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>
    
                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
