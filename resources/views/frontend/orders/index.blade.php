@extends('frontend.layouts.app')

@section('title', __('My Orders'))

@section('content')  


<div class="container ">
    
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark"> 
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
                        <a  href="{{ route('frontend.user.orders.show', $order)}} "
                        class="btn btn-primary btn-xs"> Details
                     </a>
                    </td>

                </tr>
            @endforeach
                  
             
              
            </tbody>

        </table>

    </div>

</div>

</div>

@endsection 