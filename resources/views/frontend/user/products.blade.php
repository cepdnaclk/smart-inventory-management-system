@extends('backend.layouts.cart_view')

@section('title', __('Component reservation'))



@section('content') 

 


    <!-- View of the cart components -->
   


    <!-- Components that are available to order -->
    <div class="row ">
        @foreach($componentItem as $product)
            <div class="col-xs-18 col-sm-6 col-md-3 pt-3">
                <div class="thumbnail">
                    @if( $product->thumb != null  )
                    
                         <a class="text-decoration-none"
                         href="{{ route('frontend.user.ordercomp', $product) }}">
                            <img src="{{ $product->thumbURL() }}" alt="{{ $product->title }}" width="255px" height="255px"
                            class="img img-thumbnail" >
                        </a>
                @else
                <a class="text-decoration-none"
                href="{{ route('frontend.user.ordercomp', $product) }}">              <span> <p style="height: 240px; width: 250px; background-color: #f4f4f4;">Not  Available</p>      </span> </a>

    
                @endif
                 
                    <div class="caption">
                        <h4>{{ $product->title }}</h4>
                        <h4>{{ $product->id }}</h4>
                        
                      
                        <p class="btn-holder">
                            <a href="{{ route('frontend.user.addToCart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> 
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection 







<!-- <div class="container">
  
  <br>
      <div class="row">
          <div class="col-lg-12 col-sm-12 col-12 main-section">
              <div class="dropdown">
                  <button type="button " class="btn btn-info" data-toggle="dropdown">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                  </button>
                  <div class="dropdown-menu">
                      <div class="row total-header-section">
                          <div class="col-lg-5 col-sm-5 col-5">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                          </div>
                          @php $total = 0 @endphp
                          @foreach((array) session('cart') as $id => $details)
                              @php $total +=  $details['quantity'] @endphp
                          @endforeach
                          <div class="col-lg-7 col-sm-7 col-7 total-section text">
                              <p>Products : <span class="text-info"> {{ $total }}  </span></p>
                          </div>
                      </div>
                      @if(session('cart'))
                          @foreach(session('cart') as $id => $details)
                              <div class="row cart-detail">
                                  <div class="col-lg-2 col-sm-2 col-2 cart-detail-img">
                                      <img src="{{ $details['image'] }}" />
                                  </div>
                                  <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                      {{ $details['name'] }}
                                      <span class="count"> Quantity : {{ $details['quantity'] }}</span>
                                  </div>
                              </div>
                              <br>
                          @endforeach
                      @endif
                      <div class="row">
                          <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                              <a href="{{ route('frontend.user.cart') }}" class="btn btn-primary btn-block">View all</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>  -->

  