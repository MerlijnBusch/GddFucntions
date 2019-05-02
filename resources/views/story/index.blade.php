@extends('layouts.master')

@section('css')

    {{--//--}}

@endsection

@section('jumbotron')

    {{--//--}}

@endsection

@section('sidebar')

    {{--//--}}
    <div class="panel-body">
        <div class="form-group">
            <input type="text" class="form-controller" id="search_stories" name="search_stories" placeholder="Search..." style="width: 100%">
        </div>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div id="insert-stories-here">


        </div>
    </div>

@endsection

@section('js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search_stories').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                method: 'POST',
                url: '{{route('ajax-story-search')}}',
                data: {
                    'data' :  $value
                },
                success: function(response){
                    document.getElementById('insert-stories-here').innerHTML = '';
                    let data = response.message;
                    for(let i = 0; i < data.length; i++){
                        let dataDisplay =
                            "<div>" +
                            "<h2>Title: " + data[i].title + "</h2>" +
                            "<p>" + data[i].body + "</p>" +
                            "<br>" +
                            "</div>";
                        $("#insert-stories-here").append(dataDisplay);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        })
    </script>

@endsection