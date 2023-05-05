@extends('backend.layouts.app')

@section('title', __('My Orders'))

@section('content')  
<div>
    <x-backend.card>
        <x-slot name="header">
        My Orders
        </x-slot>

        <x-slot name="body">

            @if (Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong>Success !</strong> {{ session('success') }}
</div>
@endif
<div class="table-responsive pt-3">
    

        <table class="table table-striped ">

            <thead > 
                <tr>
                    <th>Id</th>
                    
                    
                    <th>Status</th>
                    <th>Ordered-Date</th>
                    <th>Picked-Date</th>
                    <th>Due-date</th>
                    <th>Remaining days</th>
                    <th>Returned Date</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

    

                
                @foreach($orders as $order)

                <tr>
                    <td>{{ $order->id  }}</td>

       
                   

                 

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

                    
                    <td>
                        <div class="row justify-content-between">
                        <a  href="{{ route('frontend.user.orders.show', $order)}} " 
                        class="btn btn-primary"> <i class="fa fa-check" title="Approval"></i>     
                     </a>
                     <a href="{{ route('frontend.user.orders.edit', $order)}}"
                     class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                  </a>

               
                    </div>
                    </td>

                </tr>
            @endforeach
                  
             
              
            </tbody>

        </table>
    </x-slot>
</x-backend.card>





</div>

@endsection 