@extends('backend.layouts.app')

@section('title', __('Order Requests - Technical Officer View'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Submitted Orders - Technical Officer View
            </x-slot>

            <x-slot name="body">
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="container table-responsive pt-3">
                    
                    <h4 class="pb-3">Waiting for Technical Officer Approval</h4>

                    <table class="table table-striped">
                        <tr>
                            <th>Order Id</th>
                            <th>Student Name</th>
                            <th>Status</th>
                            <th>Components</th>
                            <th>Quantity</th>
                            <th>Due Date</th>
                            <th>Returned Date</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($orderRequests as $orderRequest)
                            <tr>
                                <td>{{ $orderRequest->id }}</td>
                                <td>
                                    {{ $orderRequest->user['name'] }}
                                </td>
                                <th>{{ $orderRequest->status }}</th>
                                
                                {{-- SHOW EVERY COMPONENTS AND THEIR QUANTITY --}}
                                <td>
                                    @foreach($orderRequest->componentItems as $componentItem)
                                            <a href="{{ route('admin.component.items.show', $componentItem) }}">
                                                {{ $componentItem->title }}
                                            </a>
                                            <br>
                                    @endforeach
                                </td>

                                <td>
                                    @foreach($orderRequest->componentItems as $componentItem)
                                        @if($componentItem->pivot_quantity == null)
                                            0
                                            @else
                                            {{ $componentItem ->pivot_quantity }}
                                        @endif
                                        <br>
                                    @endforeach
                                </td>

                                <td>
                                    @if( $orderRequest->due_date_to_return != null )
                                        {{ $orderRequest->due_date_to_return }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if( $orderRequest->returned_date != null )
                                        {{ $orderRequest->returned_date }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="d-flex justify-content-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.orders.officer.submitted.confirm', $orderRequest)}}"
                                            class="btn btn-primary btn-xs">
                                            <i class="fa fa-check" title="Approval"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.orders.officer.show', $orderRequest)}}"
                                           class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                         @endforeach

                    </table>
                    {{ $orderRequests->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
