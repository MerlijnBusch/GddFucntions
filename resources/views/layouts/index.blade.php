@extends('layouts.master')

@section('css')

@endsection

@section('content_with_out_sidebar')

       <div>
           <img class="img-fluid" src="{{asset('images/home.png')}}" alt="gracht in amsterdam"
                style="
                     margin-left: -20px;
                     margin-right: -20px;
                     max-width: 100vw;
                     margin-top: -32px;
                ">
       </div>

        <div class="text-center" onclick="myFunction()" style="height: 150px">
            <img class="arrow bounce" src="{{asset('images/ArrowBLU.png')}}" alt="down arrow">
        </div>

    <div id="content-main">
        <div class="row">
            <div class="col-sm-6" style="padding: 10px 15px 10px 15px" onclick="window.location.href ='{{route('district.index')}}';
            ">
                <img src="{{asset('images/Homepage-01.png')}}" alt="home page" class="img-fluid">
            </div>
            <div class="col-sm-6" style="padding: 10px 15px 10px 15px" onclick="window.location.href ='{{route('metric.index')}}';
                    ">
                <img src="{{asset('images/Homepage-02.png')}}" alt="home page" class="img-fluid">
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function myFunction() {
            let position = $("#content-main").offset().top;
            if(position > 1200){
                position = 1200;
            }
            console.log(position);
            window.scrollBy({
                top: position,
                left: 0,
                behavior: 'smooth'
            });
        }
    </script>
@endsection