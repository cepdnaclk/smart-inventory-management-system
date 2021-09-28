@extends('backend.layouts.app')

@section('title', __('Order'))

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Orders
            </x-slot>
{{-- 
            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.component.items.create')"
                            :text="__('Create Component')"></x-utils.link>
                </x-slot>
            @endif --}}

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
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Ordered-Date</th>
                            <th>Picked-Date</th>
                            <th>Due-date</th>
                            <th>Remaining days</th>
                            <th>Returned Date</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($orders as $order)

                            <tr>
                                <td>{{ $order->id  }}</td>

                                <td>{{ $order->user->name  }}</td>
                   
                                <td>
                                    @foreach ($order->componentItems as $item)
                                    <li>{{$item->title}}</li>
                                    @endforeach            
                                </td>

                                <td>
                                    @foreach ($order->componentItems as $item)
                                    <li>{{$item->pivot->quantity}}</li>
                                    @endforeach            
                                </td>

                                <td>{{ $order->status  }}</td>
                                <td>{{ $order->ordered_date  }}</td>
                                @if($order->picked_date!=NULL)
                                <td>{{ $order->returned_date  }}</td>                    
                                @else
                                <td>Not Picked up</td> 
                                @endif
                                <td>{{ $order->due_date_to_return  }}</td>
                                <td>{{ $order->dueDays()  }}</td>

                                @if($order->returned_date!=NULL)
                                <td>{{ $order->returned_date  }}</td>                    
                                @else
                                    @if ($order->dueDays()<=0)
                                    <td><span class="text-danger">Not Returned<span></td> 
                                    @else
                                    <td>Not Returned</td> 
                                    @endif
                                @endif


                                
                                

                            </tr>
                        @endforeach
                    </table> 

                    {{ $orders->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
