@extends('frontend.layouts.app')

@section('title', __('My Orders'))

@section('content')  


<div class="container">
    
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
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
                  
                </tr>
            </thead>
            <tbody>

    

                
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
                  
             
              
            </tbody>

        </table>

    </div>

</div>

</div>

@endsection 