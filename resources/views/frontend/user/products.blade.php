
@extends('frontend.layouts.cart_view') 

@section('title', __('Products Available'))

@section('content')   

<div class="row">
    @foreach($componentItem as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="{{ $product->image }}" alt="">
                <div class="caption">
                    <h6>{{ $product->title }}</h6>
                    <h6>{{ $product->id }}</h6>
                    <!--p>{{ $product->description }}</p-->
                    <p class="btn-holder">
                        <a href="{{ route('frontend.user.addToCart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> 
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection 