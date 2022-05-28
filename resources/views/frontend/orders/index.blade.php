@extends('frontend.layouts.cart_view') 

@section('title', __('Products Available'))

@section('content')  


<div class="container">
    
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UserId</th>
                    <th>Ordered_Date</th>
                  
                   
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>

    

                <tr>
                   
                    <td><?=$user_id?></td>
                    <td><?=$order_date?></td>
                    <td></td>
                </tr>
              
            </tbody>

        </table>

    </div>

</div>

</div>

@endsection 