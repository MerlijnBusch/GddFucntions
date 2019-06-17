@extends('layouts.master')

@section('sidebar')
    <div class="form-group">
        <label for="sel1">Select District:</label>
        <select class="form-control" id="sel1">
            <option>Zuid</option>
            <option>Oost</option>
            <option>ZuidOost</option>
            <option>West</option>
            <option>Nieuw-West</option>
            <option>Centrum</option>
            <option>Noord</option>
        </select>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-xl-3" onclick="start()"><img class="img-fluid" src="{{asset('images/thumb1.png')}}" alt="image" style="max-width: 350px"></div>
        <div class="col-12 col-md-6 col-xl-3" onclick="start()"><img class="img-fluid" src="{{asset('images/thumb2.png')}}" alt="image" style="max-width: 350px"></div>
        <div class="col-12 col-md-6 col-xl-3" onclick="start()"><img class="img-fluid" src="{{asset('images/thumb3.png')}}" alt="image" style="max-width: 350px"></div>
        <div class="col-12 col-md-6 col-xl-3" onclick="start()"><img class="img-fluid" src="{{asset('images/thumb4.png')}}" alt="image" style="max-width: 350px"></div>
    </div>
    <br>
    <h4 id="name_here"></h4>
    <br>
    <div style="max-width: 1500px;">
        <canvas id="canvas"></canvas>
    </div>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>

    function randomScalingFactor() {
        return Math.floor(Math.random() * Math.floor(30) + 1);
    }

    $('#sel1').on('change', function() {
        $('#name_here').html(this.value);
    });

    var start = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        var barChartData = {
            labels: ['2012', '2013', '2014', '2015', '2016', '2017', '2018'],
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: 'red',
                borderColor: 'red',
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }, {
                label: 'Dataset 2',
                backgroundColor: 'blue',
                borderColor: 'blue',
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }]

        };
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart'
                }
            }
        });
    };
</script>
@endsection
