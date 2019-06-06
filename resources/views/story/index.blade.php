@extends('layouts.master')

@section('css')

    <link href="{{asset('css/masonry.css')}}" rel="stylesheet">

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

        const chart = function createBarChart(ArrayData, id){
            var tmpHtml = "";
            if(ArrayData.length >= 1){
                for(let i = 1; i < ArrayData.length; i++){
                    tmpHtml = tmpHtml + "<p>" + ArrayData[i].bar.barTitle + "</p>" +
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
                    console.log(response);
                    for(let i = 0; i < data.length; i++){
                        let dataDisplay =
                            "<div class=\"card\">" +
                            "<b class=\"card-title\">Title: " + data[i].title + "</b><br>" +
                            "<p class=\"card-body\">" + data[i].description + "</p>" +
                            "<div id=\"persona" + data[i].id +"\" class=\"masonry\"></div>" +
                            "</div>";
                        $("#insert-stories-here").append(dataDisplay);
                        // console.log(JSON.parse( data[i].json));
                        var x = JSON.parse(data[i].json);
                        for(let j = 0; j < x.length; j++) {
                            console.log(x[j]);
                            console.log("test");
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