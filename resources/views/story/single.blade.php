@extends('layouts.master')

@section('css')

    <link href="{{asset('css/masonry.css')}}" rel="stylesheet">

@endsection

@section('jumbotron')

    <style>
        p b {
            color: white;
        }
    </style>
    {{--{{dd($story)}}--}}
    <div class="card border-left-0 border-right-0 border-top-0" style="color: white;background-color: black;">
         <div class="row" style="background-color: #F1463E;padding: 20px; margin: 40px">
             <div class="col-3 border-right border-white"> <b class="card-title display-4">{{$story->title}}</b></div>
             <div class="col-9"><p class="card-body text-left" style="font-size: 22px">{{$story->description}}</p></div>
        </div>
    <div id="persona" class="masonry">
        <div class="item">
            <div class="text-left">
                <h5 style="color: black">{{$story->second_title}}</h5>
                <p style="color: black">{{$story->second_description}}</p>
            </div>
    </div>
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


        const chart = function createBarChart(ArrayData, id){
            var tmpHtml = "";
            console.log(ArrayData);
            if(ArrayData.length >= 1){
                for(let i = 1; i < ArrayData.length; i++){
                    console.log(ArrayData[i]);
                    tmpHtml = tmpHtml + "<b style='font-size:15px;text-align: left; margin-bottom: -10px;border-left: 5px solid #272A62;'>" + "&nbsp;&nbsp;" + ArrayData[i].bar.barTitle + "</b>" +
                        "<div class=\"progress-bar horizontal\" style='margin-top: -15px; border-left: 5px solid #272A62;margin-bottom: -2px;height: 80px;'>" +
                        "   <div class=\"progress-track\">" +
                        "       <div class=\"progress-fill\" style='height:50px'>" +
                        "           <span style='line-height: 50px;font-size: 40px'>" +  ArrayData[i].bar.percentage + "%</span>" +
                        "       </div>" +
                        "   </div>" +
                        "</div>";
                }
            }
            let html =
                "<div class=\"item\">" +
                "<div class=\"container-barchart horizontal flat\">" +
                "<h4 class='text-left'>" + ArrayData[0].titlePersona + "</h4>" +
                tmpHtml
                +"</div></div>";
            $("#persona").append(html);
            $('.horizontal .progress-fill span').each(function(){
                var percent = $(this).html();
                $(this).parent().css('width', percent);
            });
            console.log('t5');
        };

        init();
        function init() {
            let stringArray = '{{$story->json}}';
            let text = stringArray.replace(/&quot;/g, '"');
            try {
                obj = JSON.parse(text); // this is how you parse a string into JSON
                console.log(obj);
                for(let k = 0; k < obj.length; k++){
                     chart(obj[k], k)
                }
            } catch (error) {
                console.error(error);
            }
        }


    </script>

@endsection