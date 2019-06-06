@extends('layouts.master')

@section('css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
            integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
            crossorigin=""></script>

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
    <div style="height: 500px">

    </div>
    <div style="background-color: #d1d1d1; margin: -20px -20px -20px -20px" >
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <h1 class="display-2 text-left" style="color: red;">Compare Metrics</h1>
                    <div style="height: 10px;width: 100%;background-color: rgba(218, 223, 225,1)"></div>
                    <br>
                    <p class="h5 text-left" style="color: red;"><b>Compare GGD and environmental datasets on your own.</b></p>
                    <br>
                    <div class="row border" onclick="location.href = '{{route('metric.index')}}'">
                        <div class="col-9" style="padding-top: 4px;color: red;background-color: white"><p class="h5 text-left"><b>Compare Now</b></p></div>
                        <div class="col-3" style="background-color: purple;color:white"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
                <div class="col-12 col-md-6" style="padding: 20px 20px 20px 20px">
                    <div id="mapid" style="height: 460px;width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 15px; margin-top: 15px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="text-center pb-3 display-3">
                        CONTACT US</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8">
                    <form class="mbr-form" action="https://mobirise.com/" method="post">
                        <div class="row row-sm-offset">
                            <div class="col-md-4 multi-horizontal" data-for="name">
                                <div class="form-group">
                                    <label class="form-control-label display-7" for="name-form1-4">Name</label>
                                    <input type="text" class="form-control" name="name" data-form-field="Name" id="name-form1-4" required>
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label display-7" for="email-form1-4">Email</label>
                                    <input type="email" class="form-control" name="email" data-form-field="Email" id="email-form1-4" required>
                                </div>
                            </div>
                            <div class="col-md-4 multi-horizontal" data-for="phone">
                                <div class="form-group">
                                    <label class="form-control-label display-7" for="phone-form1-4">Phone</label>
                                    <input type="tel" class="form-control" name="phone" id="phone-form1-4">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label display-7" for="message-form1-4">Message</label>
                            <textarea type="text" class="form-control" name="message" rows="7" ></textarea>
                        </div>

                        <span class="input-group-btn"><button href="" type="submit" class="btn btn-form btn-black-outline display-4">SEND FORM</button></span>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        function myFunction() {
            const position = $("#content-main").offset().top;
            window.scrollBy({
                top: position,
                left: 0,
                behavior: 'smooth'
            });
            console.log("test2");
        }

        var mymap = L.map('mapid').setView([52.370216, 4.895168], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1Ijoia2lkYXJlc29jb29sdGhlc2VkYXlzIiwiYSI6ImNqdG84MTRvMTJzN2s0YXJyZ2pmZ3g1cXEifQ.ENP5bc7JYntpdzhi0ahqCw'
        }).addTo(mymap);
    </script>
@endsection