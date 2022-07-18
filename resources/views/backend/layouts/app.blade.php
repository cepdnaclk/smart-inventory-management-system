<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Department of Computer Engineering')">

    @yield('meta')

    @stack('before-styles')

    {{--  This is the only version compatible with LiveWire tables so far --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

    <livewire:styles/>
    @stack('after-styles')
</head>
<body class="c-app">
@include('backend.includes.sidebar')

<div class="c-wrapper c-fixed-components">
    @include('backend.includes.header')
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    @include('includes.partials.announcements')

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--fade-in-->
            </div><!--container-fluid-->
        </main>
    </div><!--c-body-->

    @include('backend.includes.footer')
</div><!--c-wrapper-->

@stack('before-scripts')
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/backend.js') }}"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({});
</script>

<livewire:scripts/>
@stack('after-scripts')

</body>
</html>
