
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>AnecData</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quillEditor.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>

@include('layouts.navbar')

<main class="container-fluid">

    @yield('jumbotron')

    @include('layouts.partials.error')
    @include('layouts.partials.success')

    <div class="row">

        <div class="col-6 col-md-3">
            <div style="padding-right: 10px">

            @yield('sidebar')
            </div>
        </div>

        <div class="col-12 col-md-9">

            @yield('content')

        </div>
    </div>

</main>
<!-- FOOTER -->
@include('layouts.footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous"></script>
<script src="{{ asset('js/quillEditor.js') }}"></script>
@yield('js')
</body>
</html>
