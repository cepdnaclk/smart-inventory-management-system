
@extends('frontend.layouts.cart_view') 

@section('title', __('Products Available'))

@section('content')   

<div class="row">
    @foreach($componentItem as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                @if( $product->thumb != null )
                <img src="{{ $product->thumbURL() }}" alt="{{ $product->title }}" width="300px" height="300px"
                     class="img img-thumbnail" >
            @else
            <p style="height: 240px; width: 250px; background-color: #f4f4f4;">&nbsp;</p>

            @endif
             
                <div class="caption">
                    <h4>{{ $product->title }}</h4>
                    <h4>{{ $product->id }}</h4>
                    
                    <div class="text-end"> <h6> {{$product->isAvailable}}</h6></div>
                  
                    <p class="btn-holder">
                        <a href="{{ route('frontend.user.addToCart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> 
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection 