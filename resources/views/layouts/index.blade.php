@extends('layouts.master')

@section('css')



@endsection

@section('content_with_out_sidebar')

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid" src="https://via.placeholder.com/2728x1200.png/0000FF/808080?Text=nerd.com" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="https://via.placeholder.com/2728x1200.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="https://via.placeholder.com/2728x1200.png/FFFFFFF/202020?Text=OOF?.com" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="text-center" onclick="myFunction()" style="height: 150px">
            <img class="arrow bounce" src="{{asset('images/ArrowBLU.png')}}" alt="down arrow">
        </div>

    <div id="content-main">
        <div class="row">
            <div class="col-sm-6" style="padding: 10px 15px 10px 15px">
                <img src="{{asset('images/Homepage-01.png')}}" alt="home page" class="img-fluid">
            </div>
            <div class="col-sm-6" style="padding: 10px 15px 10px 15px">
                <img src="{{asset('images/Homepage-02.png')}}" alt="home page" class="img-fluid">
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function myFunction() {
            const position = $("#content-main").offset().top;
            console.log("test");
            window.scrollBy({
                top: position,
                left: 0,
                behavior: 'smooth'
            });
            console.log("test2");
        }
    </script>
@endsection