<header class="c-header c-header-light c-header-fixed">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
    </a>

    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('frontend.index') }}">@lang('Home')</a></li>

        @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
        <li class="c-header-nav-item dropdown">
            <x-utils.link
            :text="__(getLocaleName(app()->getLocale()))"
            class="c-header-nav-link dropdown-toggle"
            id="navbarDropdownLanguageLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false" />

            @include('includes.partials.lang')
        </li>
        @endif
    </ul>
    

    <ul class="c-header-nav ml-auto mr-3 ">
        <li class="d-flex   mr-5">
            <div class="container">
        <div class="row ">
            <div class="col-lg-12 col-sm-12 col-12 main-section">
                <div class="dropdown">
                    <button type="button " class="btn btn-primary  btn-200" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </button>
                    <div class="dropdown-menu pre-scrollable">

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
    </div>
        </li>
        <li class="c-header-nav-item dropdown">
           
            <x-utils.link class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <x-slot name="text">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="{{ $logged_in_user->avatar }}" alt="{{ $logged_in_user->email ?? '' }}">
                    </div>
                </x-slot>
            </x-utils.link>

            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>
                        <!-- @lang('Account') -->
                        {{{ isset(Auth::user()->email) ? Auth::user()->email : "" }}}
                    </strong>
                </div>

                <x-utils.link class="dropdown-item" href="{{ route('frontend.user.dashboard' )}}" icon="c-icon mr-2 cil-gear">
                    <x-slot name="text">
                        User Dashboard
                    </x-slot>
                </x-utils.link>

                <x-utils.link class="dropdown-item" href="{{ route('frontend.user.account' )}}" icon="c-icon mr-2 cil-gear">
                    <x-slot name="text">
                        Profile
                    </x-slot>
                </x-utils.link>

                <x-utils.link class="dropdown-item" icon="c-icon mr-2 cil-account-logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <x-slot name="text">
                    @lang('Logout')
                    <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                </x-slot>
            </x-utils.link>

        </div>
    </li>
</ul>

<div class="c-subheader justify-content-between px-3">
    @include('backend.includes.partials.breadcrumbs')

    <div class="c-subheader-nav mfe-2">
        @yield('breadcrumb-links')
    </div>
</div><!--c-subheader-->
</header>