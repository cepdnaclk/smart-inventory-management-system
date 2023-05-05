@extends('backend.layouts.app')

@section('title', __('Order Requests - Lecturer View'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
               Order Request by
                @if($order->user_id != null)
                    <b>{{$order->user->name }}</b>
                @endif
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Order#{{ $order->id }}</h4>
                    </div>
                    @if ($order->orderApprovals->is_approved_by_lecturer == 1 && $order->status=="WAITING_H_O_D_APPROVAL")
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.orders.h_o_d.approve', $order)}}"
                            class="btn btn-primary btn-xs me-2"><i class="fa fa-check" title="Approve"></i>
                             Approve
                            </a>

                            <a  href="{{ route('admin.orders.h_o_d.rejected', $order)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                Reject
                            </a>
                        </div>
                    </div>
                    @endif
                  
                </div>
                <table class="table">

                    <tr>
                        <td>Student Name</td>
                        <td> {{$order->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Student Email</td>
                        <td> {{$order->user->email }}</td>
                    </tr>
                    <tr>
                        <td>Lecturer Name</td>
                        <td>{{$order->orderApprovals->lecturer->name }}</td>
                    </tr>
                    <tr>
                        <td>Lecturer Email</td>
                        <td>{{$order->orderApprovals->lecturer->email }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><b>{{$order->status }}</b></td>
                    </tr>
                

                    <tr>
                        <td>Description</td>
                        <td>{{$order->description}}</td>
                    </tr>

                   

                    <tr>
                        <td>
                            Ordered-Date
                        </td>
                        <td>
                            {{$order->ordered_date}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                           Picked Date
                        </td>
                        <td>
                            {{$order->picked_date}}
                        </td>
                    </tr>


                    <tr>
                        <td>
                            due_date_to_return
                        </td>
                        <td>
                            {{$order->due_date_to_return}}
                        </td>
                    </tr>

                    <tr>
                        <td>Components</td>
                        <td>
                            @if($order->componentItems != null)
                            <div class="">
                                @foreach ($order->componentItems as $item)
                                
                                    <div class="d-flex align-items-center justify-content-between col-9">
                                        <div>
                                            <a href="{{ route('admin.orders.show', $item->title) }}">
                                                {{  $item->title }}
                                            </a>
                                        </div>
                                        <div>
                                           {{  $item->pivot->quantity }}
                                        </div>
                                    </div>
                                        
                                @endforeach
                            </div>

                                
                            @endif

                           
                        </td>
                    </tr>
                   

                   
                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
