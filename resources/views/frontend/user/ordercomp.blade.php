@extends('frontend.layouts.app')

@section('title', __('Component details'))

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

    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12 d-flex mb-4">
                @if( $componentItem->thumb != null )
                    <img src="{{ $componentItem->thumbURL() }}"
                         alt="{{ $componentItem->title }}"
                         class="img img-thumbnail img-fluid p-3 mx-auto">
                @else
                    {{-- TODO: Add a default image --}}
                    <span>[Not Available]</span>
                @endif

            </div>
            <div class="col-md-8 col-sm-12 col-12 mb-4">
                <h3>{{ $componentItem->title }} <br>
                    <small class="text-muted">
                        {{ $componentItem->inventoryCode() }}
                        <hr>
                    </small>
                </h3>

                <div>
                    <table>
                        <tr>
                            <td>Category</td>
                            <td>
                                : @if($componentItem->component_type->parent() != null)
                                    <a href="{{ route('frontend.component.category', $componentItem->component_type->parent() ) }}">
                                        {{ $componentItem->component_type->parent()->title }}
                                    </a> &gt;
                                @endif

                                <a href="{{ route('frontend.component.category', $componentItem->component_type) }}">
                                    {{ $componentItem->component_type['title'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Product Code</td>
                            <td>
                                : <b>{{ $componentItem->productCode }}({{ $componentItem->brand }})</b>
                            </td>
                        </tr>

                        <tr>
                            <td>Available Quantity</td>
                            <td>
                                : <b>{{ $componentItem->quantity }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Dimensions</td>
                            <td>
                                : <b>
                                    @if( $componentItem->width!=0 && $componentItem->height!=0 && $componentItem->length!=0)
                                        {{ $componentItem->width }} x {{ $componentItem->height }}
                                        x {{ $componentItem->length }} cm <br>
                                    @else
                                        <span>[Not Available]</span> <br>
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>
                                : <b>
                                    @if( $componentItem->weight != null )
                                        {{ $componentItem->weight." g"}}
                                    @else
                                        <span>[Not Available]</span>
                                    @endif
                                </b>
                            </td>
                        </tr>
                    </table>
                </div>

                @if($componentItem->isElectrical && $componentItem->powerRating != null)
                    <div class="pt-3">
                        Power Rating: {{ $componentItem->powerRating." W"}}
                    </div>
                @endif

                @if($componentItem->description !== null)
                    <div class="pt-3">
                        <u>Description</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $componentItem->description) !!}
                        </div>
                    </div>
                @endif

                @if($componentItem->specifications !== null)
                    <div class="pt-3">
                        <u>Specifications</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $componentItem->specifications) !!}
                        </div>
                    </div>
                @endif


                @if($componentItem->instructions !== null)
                    <div class="pt-3">
                        <u>Usage Instructions</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $componentItem->instructions) !!}
                        </div>
                    </div>
                @endif


                
            </div>

            <div class="col-md-8 col-sm-12 col-12 mb-4">
                <!-- <div class="pt-3">
                    <label for="quantity">No. of components reserving:</label>
                    <input type="number" id="quantity" name="quantity" min="1"><br>
                </div> -->

                <div class="pt-3">
                    <p class="btn-holder">
                        <a href="{{ route('frontend.user.addToCart', $componentItem->id) }}" class="btn btn-warning" role="button">Add to cart</a>
                    </p>
                </div>

                <a href="{{ route('frontend.user.products') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Back to components</a>

            </div>

        </div>      

    </div>
    
    
    



    
@endsection