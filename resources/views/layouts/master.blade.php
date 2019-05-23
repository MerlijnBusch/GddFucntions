
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>AnecData</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    @yield('css')
</head>
<body>

@include('layouts.navbar')

<main class="container-fluid">

    @yield('jumbotron')

    @include('layouts.partials.error')
    @include('layouts.partials.success')

    <div class="row">

        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div style="padding-right: 10px">

            @yield('sidebar')
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 col-xl-10">

            @yield('content')

        </div>
    </div>

    @yield('content_with_out_sidebar')

</main>
<!-- FOOTER -->
@include('layouts.footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
