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
    <p class="display-4" style="color: white">Select topic</p>
    <div style="overflow: hidden">
        <div style="padding:5px 5px 5px 5px" class="float-left" id="Elderly falls" onclick="start(this.id)"><img class="img-fluid" src="{{asset('images/thumb1.png')}}" alt="image" style="max-width: 300px; margin: 5px 5px 5px 5px"></div>
        <div style="padding:5px 5px 5px 5px" class="float-left" id="Social Cohesion" onclick="start(this.id)"><img class="img-fluid" src="{{asset('images/thumb2.png')}}" alt="image" style="max-width: 300px; margin: 5px 5px 5px 5px"></div>
        <div style="padding:5px 5px 5px 5px" class="float-left" id="Child Obesity" onclick="start(this.id)"><img class="img-fluid" src="{{asset('images/thumb3.png')}}" alt="image" style="max-width: 300px; margin: 5px 5px 5px 5px"></div>
        <div style="padding:5px 5px 5px 5px" class="float-left" id="Sound Pollution" onclick="start(this.id)"><img class="img-fluid" src="{{asset('images/thumb4.png')}}" alt="image" style="max-width: 300px; margin: 5px 5px 5px 5px"></div>
    </div>
    <br>
    <h4 id="name_here" style="color: white;"></h4>
    <br>
    <div style="max-width: 1500px; background-color: #E8F1F0">
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

    var ctx = document.getElementById('canvas').getContext('2d');
    var barChartData = {
        labels: ['2012', '2013', '2014', '2015', '2016', '2017', '2018'],
        datasets: [{
            label: 'Man',
            backgroundColor: '#282667',
            borderColor: '#282667',
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
            label: 'Women',
            backgroundColor: '#E22028',
            borderColor: '#E22028',
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
                text: 'Elderly falls',
                fontSize: 24
            }
        }
    });

    var start = function(id) {
        var data = {
            labels: ['2012', '2013', '2014', '2015', '2016', '2017', '2018'],
            datasets: [{
                label: 'Man',
                backgroundColor: '#282667',
                borderColor: '#282667',
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
                label: 'Women',
                backgroundColor: '#E22028',
                borderColor: '#E22028',
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
        console.log();
        console.log();
        myBar.options.title.text = id;
        myBar.data = data;
        myBar.update();
    };
</script>
@endsection
