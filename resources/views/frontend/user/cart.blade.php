
@extends('backend.layouts.cart_view') 
@section('title', __('My Cart'))


@section('content')  
<x-backend.card>
    <x-slot name="header">
    My Cart
    </x-slot>

    <x-slot name="body">
<table id="cart" class="table  ">
    <thead>
        <tr>
            <th style="width:50%">Product</th>            
            <th style="width:7%">Quantity</th>           
            <th style="width:2%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">

                            <div class="col-sm-9">
                               {{ $details['name'] }}
                            </div>
                        </div>
                    </td>
                   
                    <td data-th="Quantity">
                     
                     <input type="number" value="{{ $details['quantity'] }}"  />
                    </td>
                   
                    
                      
                    
                    <td class="actions" data-th="">
                      <a  class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i> </a>

                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr >
            <td> <a href="{{ route('frontend.user.products') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Back to components</a></td>

            <td colspan="5" class="text-right"><h4><strong>Total Items : {{ $total }}</strong></h4></td>

        </tr>
        <tr>
            <td colspan="5" class="text-right">
                
                <form action="{{route('frontend.user.place.order')}}" method="post">
                    {{ csrf_field() }}
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <input type="hidden" name="product[]" value="{{$id}}">
                            <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">                
                        @endforeach
                    @endif 
                    <br> 
                    
                   
                        <input type="submit"  class="btn btn-success  "  value="Place reservation">
                        
                                
                    
                </form>
            </td>
        </tr>
    </tfoot>
</table>
</x-slot>
</x-backend.card>
@endsection


@section('scripts')

<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('frontend.user.update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('frontend.user.remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>

@endsection