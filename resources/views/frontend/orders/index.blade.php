@extends('backend.layouts.app')

@section('title', __('My Orders'))

@section('content')  
<div>
    <x-backend.card>
        <x-slot name="header">
        My Orders
        </x-slot>

        <x-slot name="body">

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
                        class="btn btn-primary"> <i class="fa fa-check" title="Approval"></i> Details    
                     </a>
                   
                     <form action="{{ route('frontend.user.orders.change.staus', $order)}} " method="POST">
                        @csrf
                        @method('PUT')
                     <input type="submit" {{ ( $order->status =="WAITING_H_O_D_APPROVAL") ? '' : 'disabled' }} value="PICKED"  class="btn btn-primary">
                     </form>

               
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