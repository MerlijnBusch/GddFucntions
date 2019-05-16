@extends('layouts.master')

@section('css')


@endsection


@section('jumbotron')

@endsection


@section('sidebar')

@endsection


@section('content')

    <div>
        <h3>{{$metric->file_name}}</h3>
        <div id="data_preview_metric">

        </div>
    </div>

@endsection


@section('js')
    <script>
        var data;

        init();
        function init() {
            var json_data = '{{$metric->data_json_version}}';
            let json_data_replaced = json_data.replace(/&quot;/g, '"');
            try {
                data = JSON.parse(json_data_replaced);
                console.log(data);
            } catch (error) {
                console.error(error);
            }
        }

    </script>
@endsection