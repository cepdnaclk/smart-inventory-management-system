<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ appName() }}</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        /* * {
            box-sizing: border-box;
        } */
    </style>
    @stack('after-styles')
</head>

<body style="font-family: Arial;">
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    @include('includes.partials.announcements')

    <div id="app" style="position: relative; height: 100vh;" class="flex-center">
        <div class="links" style="position: absolute; right: 10px; top: 18px;">
            @auth
                @if ($logged_in_user->isAdminAccess())
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                @endif

                <a href="{{ route('frontend.user.overview') }}">User Overview</a>

                <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
            @else
                <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

                @if (config('boilerplate.access.user.registration'))
                    <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                @endif
            @endauth
        </div>
        <!--top-right-->


        <div style="text-align: center;">
            @include('includes.partials.messages')


            <div style="margin-bottom: 30px; font-size: 84px;" id='cesmart'>
                {{ config('app.name', 'Laravel') }}
            </div>
            <!--title-->

            <div class="container flex row g-3 align-items-center justify-content-center">
                {{-- {!! Form::open(['route' => 'frontend.frontSearch.results', 'method' => 'GET'], ['class' => 'searchBar']) !!}
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="input-group">
                            <input type="search" id="keywords" class="form-control form-control-lg"
                                placeholder="Search" name="keywords" required />
                            <button id="search-button" type="submit" class="btn btn-primary px-3 form-control-lg">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }} --}}

                {!! Form::open(['route' => 'frontend.frontSearch.results', 'method' => 'GET', 'class' => 'w-100']) !!}
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="search" id="keywords" class="form-control form-control-lg"
                                placeholder="Search" name="keywords" required />
                            <button id="search-button" type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>


            <div class="links p-5">
                {{--            <a href="http://laravel-boilerplate.com" target="_blank"><i class="fa fa-book"></i> @lang('Docs')</a> --}}
                <a href="https://github.com/cepdnaclk/smart-inventory-management-system" target="_blank"><i
                        class="fab fa-github"></i>
                    GitHub</a>

                <a href="{{ route('frontend.component.index') }}">Components</a>
                <a href="{{ route('frontend.equipment.index') }}">Equipment</a>
                <a href="{{ route('frontend.consumable.index') }}">Consumables</a>
                <a href="{{ route('frontend.stations.index') }}">Stations</a>

            </div>
            <!--links-->
        </div>
        <!--content-->
    </div>
    <!--app-->

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
