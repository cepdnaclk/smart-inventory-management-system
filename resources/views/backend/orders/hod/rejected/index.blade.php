@extends('backend.layouts.app')

@section('title', __('Order Requests - Lecturer View'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
            Order Accepted - Lecturer View
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
              
                    <h4 class="pb-3">REJECTED</h4>
                    <table class="table table-striped align-middle">

                        <tr>
                            <th>OrderID</th>
                            <th>User Name</th>
                            <th>status</th>
                            <th>OrderedDate</th>
                           
                            <th>&nbsp; </th>
                        </tr>

                        @foreach($orderApproval as $order)
                        @if ($order->orders->status=="REJECTED")
                                <tr>
                                   
                                    <td>{{ $order->orders->id }}</td>
                                    <td>{{ $order->orders->user->name }}</td>
                                    <td><b> {{ $order->orders->status }}</b></td>


                                        <td>
                                            {{ $order->orders->ordered_date }}</td>

                                        
                                            <td class="d-flex justify-content-end">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.orders.h_o_d.show',$order->orders)}}"
                                                       class="btn btn-primary btn-xs">
                                                        <i class="fa fa-check" title="Approval"></i>
                                                    </a>
                                                  </td>

                                </tr>
                                @endif
                        @endforeach
                    </table>

                </div>


               
          
            </x-slot>
        </x-backend.card>
    </div>
@endsection
