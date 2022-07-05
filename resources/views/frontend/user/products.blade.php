@extends('frontend.layouts.app')

@section('title', __('Component reservation'))

@push('after-styles')

    <style>
        .ordercomp{
        /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); */
        /* max-width: 300px; */
        
        margin: auto;
        text-align: center;
        font-family: arial;
        }

        .components {
        display: flex;
        flex-wrap: wrap;
        margin-right: 30px;
        margin-left: 30px;
        padding:30px;
        width: 75%;
        height:700px;
        float:left;
        overflow:hidden;
        overflow-y:scroll;
        
        }

        .cartcomponents{
        background:#eff0eb;
        width: 20%;
        padding:20px;
        height:700px;
        float:left;
        overflow:hidden;
        overflow-y:scroll;
        }

        .img-ordercomp {
        padding: 0.25rem;
        background-color: #f8fafc;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
        float:left;
        }

        .price {
        color: grey;
        font-size: 22px;
        }

        .card button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
        }

        .card button:hover {
        opacity: 0.7;
        }
    </style>
@endpush

@section('content') 

    <!--Home/Component navigation bar  -->
    <nav id="breadcrumbs" aria-label="breadcrumb">
        <ol class="container breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="http://127.0.0.1:8000" class="">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                @yield('title')
            </li>
        </ol>
    </nav>


    <!-- View of the cart components -->
    <div class="cartcomponents">
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



    <!-- Components that are available to order -->
    <div class="components">
    @foreach($componentItem as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                
                @if( $product->thumb != null )
                <!-- <button type="button"><img src="{{ $product->thumbURL() }}" alt="{{ $product->title }}" width="300px" height="300px"
                     class="img img-thumbnail" ></button> -->
                     <a class="text-decoration-none"
                     href="{{ route('frontend.user.ordercomp', $product) }}">
                        <img src="{{ $product->thumbURL() }}" alt="{{ $product->title }}" width="255px" height="255px"
                        class="img img-thumbnail" >
                    </a>
            @else
            <!-- <button type="button"><img src="https://cdn1.vectorstock.com/i/thumb-large/27/95/white-square-blank-mockup-vector-10242795.jpg" alt="{{ $product->title }}" width="300px" height="300px"
                     class="img img-thumbnail" ></button> -->
                     <!-- <a class="text-decoration-none"
                        href="{{ url('ordercomp') }}"> -->
                     <!-- <img src="https://png.pngitem.com/pimgs/s/117-1172906_fidji-dinner-in-bernardaud-square-white-plate-png.png" alt="{{ $product->title }}" width="300px" height="300px"
                     class="img img-thumbnail" >
                     </a> -->
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

  