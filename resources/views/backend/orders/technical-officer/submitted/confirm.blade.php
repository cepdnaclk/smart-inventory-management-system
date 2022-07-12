@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Orders : Confirm | Order #{{ $orderRequest->id  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Order #{{ $orderRequest->id }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.orders.officer.finish', $orderRequest)}}"
                               class="btn btn-primary btn-xs me-2"><i class="fa fa-check" title="Approve"></i>
                               Confirm and Email to student
                            </a>
                        </div>
                    </div>
                </div>
                
                <table class="table">
                    <tr>
                        <td>Status</td>
                        <td><b>{{ $orderRequest->status}}</b></td>
                    </tr>

                    <tr>
                        <td>
                            Components
                        </td>
                        <td>
                            @foreach($orderRequest->componentItems as $componentItem)
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
                        <td>Description</td>
                        @if( $orderRequest->description != null )
                            <td>{{ $orderRequest->description }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Approved Lecture</td>
                        <td>
                            @if($orderRequest->orderApprovals != null)
                                {{ $orderRequest->orderApprovals->lecturer['name'] }}
                                ( {{ $orderRequest->orderApprovals->lecturer['email'] }} )
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Approved Technical officer</td>
                        <td>
                            @if($orderRequest->orderApprovals != null)
                                {{ $orderRequest->orderApprovals->technicalOfficer['name'] }}
                                ( {{ $orderRequest->orderApprovals->technicalOfficer['email'] }} )
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Order Requested at</td>
                        @if( $orderRequest->ordered_date != null )
                            <td>{{ $orderRequest->ordered_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Expected Date</td>
                        @if( $orderRequest->expected_date != null )
                            <td>{{ $orderRequest->expected_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Picked at</td>
                        @if( $orderRequest->picked_date != null )
                            <td>{{ $orderRequest->picked_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Due Date</td>
                        @if( $orderRequest->due_date_to_return != null )
                            <td>{{ $orderRequest->due_date_to_return }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Returned at</td>
                        @if( $orderRequest->returned_date != null )
                            <td>{{ $orderRequest->returned_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Locker Id <br>(if placed)</td>
                        @if( $orderRequest->locker_id != null )
                            <td>
                                <a href="{{ route('admin.locker.details.show', $orderRequest->locker_id) }}">
                                {{ $orderRequest->locker_id }}
                                </a>
                            </td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>
                </table>

            </x-slot>
        </x-backend.card>
    </div>
@endsection
