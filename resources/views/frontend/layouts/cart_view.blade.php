<!DOCTYPE html>
<html>

<head>

    <title>Laravel Add To Cart Function - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        @include('frontend.includes.nav')
        @include('includes.partials.messages')
    </div>
    <!--app-->

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

    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 main-section">
                <div class="dropdown">
                    <button type="button" class="btn btn-info" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                            class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-5 col-sm-5 col-5">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                    class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </div>
                            @php $total = 0 @endphp
                            @foreach ((array) session('cart') as $id => $details)
                                @php $total +=  $details['quantity'] @endphp
                            @endforeach
                            <div class="col-lg-7 col-sm-7 col-7 total-section text">
                                <p>Products : <span class="text-info"> {{ $total }} </span></p>
                            </div>
                        </div>
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
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
                                <a href="{{ route('frontend.user.cart') }}" class="btn btn-primary btn-block">View
                                    all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />

    <div class="container">
        @if (session('success'))
            <x-utils.alert type="success" class="header-message">
                {{ session('success') }}
            </x-utils.alert>
        @endif

        @yield('content')

    </div>

    @yield('scripts')

</body>

</html>
