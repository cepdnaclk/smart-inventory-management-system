@extends('backend.layouts.app')

@section('title', __('Order Requests - HOD View'))

@section('breadcrumb-links')
@endsection


@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
            Order Requests - HOD
            </x-slot>

            <x-slot name="body">
           

                {{-- Message --}}
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Success !</strong> {{ session('success') }}
        </div>
        @endif

                <div class="container table-responsive pt-3">
              
                    <h4 class="pb-3">Waiting for Lecturer Approval -  {{auth()->user()->name}} </h4>
                    <table class="table table-striped align-middle">

                        <tr>
                            <th>OrderID</th>
                            <th>User Name</th>
                            <th>Lecturer Name</th>
                            <th>status</th>
                            <th>OrderedDate</th>
                           
                            <th>&nbsp; </th>
                        </tr>

                        @foreach($orderApproval as $order)
                                @if ($order->orders->status=='WAITING_H_O_D_APPROVAL')
                                <tr>
                                 
                                    <td>{{ $order->orders->id }}</td>
                                    <td>{{ $order->orders->user->name }}</td>
                                    <td>{{$order->lecturer->name}}</td>
                              
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
