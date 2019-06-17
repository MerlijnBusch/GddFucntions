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
    <div class="card border-left-0 border-right-0 border-top-0" style="color: white;background-color: black">
    <b class="card-title"></b>{{$story->title}}<br>
    <div class="row">
        <div class='col-12 col-md-6 col-lg-8'>
            <p class="card-body">{{$story->description}}</p>
            <br>
            <b>Advice</b>
            <p>
                is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de
                16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar
                husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd
                is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de
                16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar
                husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd
            </p>
            </div>
        <div class="col-12 col-md-6 col-lg-3">
        <img class='img-thumbnail' style='height: 350px;width: 350px' src='{{url('/') .'/uploadedImages/'. $story->path}}'>
        </div>
    </div>
    <div id="persona" class="masonry"></div>
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