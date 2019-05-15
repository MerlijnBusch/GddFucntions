@extends('layouts.master')

@section('css')


@endsection


@section('jumbotron')

@endsection


@section('sidebar')

@endsection


@section('content')
    <h1>Moderator</h1>
    <form method="POST" action="">
        <input type="file" id="myDOMElementId">
        <button type="submit">Submit</button>
    </form>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{asset('js/papaparse.min.js')}}"></script>
    <script>

        var data;

        function parse() {
            var file = document.getElementById('myDOMElementId').files[0];

            Papa.parse(file, {
                header: true,
                dynamicTyping: true,
                complete: function(results) {
                    data = results.data;
                    console.log("Finished:", results.data);
                }
            });
        }
    </script>
@endsection