@extends('layouts.master')

@section('css')

    <link href="{{asset('css/masonry.css')}}" rel="stylesheet">

@endsection

@section('jumbotron')

    {{--//--}}

    <div style="padding: 15px 15px 15px 15px;overflow: hidden">
    @foreach($story as $s)
        @if($s->accepted == 'true')
        <div class="float-left" style="margin: 3px 3px 3px 3px">
            <div class="card" style="width: 350px;position: relative;
    text-align: center;">
                <img class="img-thumbnail" style="height: 350px;width: 350px" src="{{asset('uploadedImages/'.$s->path)}}" alt="{{$s->title}}">
                <b style="position: absolute;
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);">{{$s->title}}</b>
            </div>
        </div>
        @endif
    @endforeach
    </div>
    <br>
    <div class="panel-body">
        <div class="form-group">
            <input type="text" class="form-controller" id="search_stories" name="search_stories" placeholder="Search..." style="width: 100%">
        </div>
    </div>
    <div class="container-fluid">
        <div id="insert-stories-here">


        </div>
    </div>

@endsection

@section('sidebar')

    {{--//--}}

@endsection

@section('content')


@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const chart = function createBarChart(ArrayData, id){
            var tmpHtml = "";
            if(ArrayData.length >= 1){
                for(let i = 1; i < ArrayData.length; i++){
                    tmpHtml = tmpHtml + "<p style='text-align: left; margin-bottom: -10px'>" + ArrayData[i].bar.barTitle + "</p>" +
                        "<div class=\"progress-bar horizontal\">" +
                        "   <div class=\"progress-track\">" +
                        "       <div class=\"progress-fill\">" +
                        "           <span>" +  ArrayData[i].bar.percentage + "%</span>" +
                        "       </div>" +
                        "   </div>" +
                        "</div>";
                }
            }
            let html =
                "<div class=\"item\">" +
                "<div class=\"container-barchart horizontal flat\">" +
                "<h2>" + ArrayData[0].titlePersona + "</h2>" +
                tmpHtml
                +"</div></div>";
            $("#persona" + id).append(html);
            $('.horizontal .progress-fill span').each(function(){
                var percent = $(this).html();
                $(this).parent().css('width', percent);
            });
        };

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
                            "<div class=\"card border-left-0 border-right-0 border-top-0\">" +
                            "<b class=\"card-title\">Title: " + data[i].title + "</b><br>" +
                            "<div class=\"row\">" +
                            "<div class='col-12 col-md-6 col-lg-8'> " +
                            "<p class=\"card-body\">" + data[i].description + "</p>" +
                            "</div>" +
                            "<div class=\"col-12 col-md-6 col-lg-3\">" +
                            "<img class='img-thumbnail' style='height: 350px;width: 350px' src='{{url('/')}}" + "/uploadedImages/" + data[i].path + "'>" +
                            "</div></div>" +
                            "<div id=\"persona" + data[i].id +"\" class=\"masonry\"></div>" +
                            "</div>";
                        $("#insert-stories-here").append(dataDisplay);
                        // console.log(JSON.parse( data[i].json));
                        var x = JSON.parse(data[i].json);
                        for(let j = 0; j < x.length; j++) {
                            chart(x[j], data[i].id);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        })
    </script>

@endsection