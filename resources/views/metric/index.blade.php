@extends('layouts.master')

@section('css')

    <link href="{{ asset('css/metric.css') }}" rel="stylesheet">

@endsection

@section('jumbotron')

    <style>
        .iframe-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

    <div class="iframe-container">
        <iframe src="https://luciadossin.net/hva-ds/"></iframe>
    </div>


@endsection

@section('sidebar')
    {{--@if(auth()->check())--}}
        {{--@include('layouts.partials.sidebarProfile')--}}
    {{--@endif--}}

    {{--<h1>Comparing metric</h1>--}}

    {{--<form class="metric_form" id="metric_form">--}}

    {{--</form>--}}


@endsection

@section('content')

    {{--<div class="button_toggle">--}}
        {{--<div class="float-left"><button class="btn btn-success btn-sm button_toggle_dataviz" onclick="toggle_toMap()">Map</button></div>--}}
        {{--<div class="float-left"><button class="btn btn-success btn-sm button_toggle_dataviz" onclick="toggle_toDataviz()">Dataviz</button></div>--}}
    {{--</div>--}}

    {{--@include('metric.partials.map')--}}

    {{--@include('metric.partials.chart')--}}

    {{--@include('metric.partials.shareStory')--}}


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{asset('js/ToggleDisplay.js')}}"></script>
    <script>

        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}

        {{--var FileNameArray = [--}}
            {{--@foreach($metrics as $metric)--}}
                    {{--file_name{{$metric->id}} = '{{$metric->file_name}}',--}}
            {{--@endforeach--}}
        {{--];--}}

        {{--var childrenArray = [];--}}
        {{--var form = document.getElementById('metric_form');--}}
        {{--for(let i = 0; i < FileNameArray.length; ++i){--}}
            {{--FileNameArray[i] = (FileNameArray[i].split('.').slice(0, -1)).join('.');--}}
            {{--let arrayNames = FileNameArray[i].split(',');--}}
            {{--for(let j = 0; j < arrayNames.length; j++){--}}
                {{--let x = $( "form.metric_form" ).children();--}}
                {{--if(j === 0){--}}
                    {{--for(let k = -1; k < x.length; k++){--}}
                        {{--if($('#' +  arrayNames[j]).length === 0){--}}
                            {{--let newDiv = document.createElement("div");--}}
                            {{--let newInput =  "<b><label for=\"" + arrayNames[j] + "\">" + arrayNames[j] + "</label></b>" +--}}
                                {{--"<input class=\"float-right " + arrayNames[j] + "\" id=\"" + arrayNames[j] + "\" type=\"checkbox\" " +--}}
                                {{--"name=\"" + arrayNames[j] + "\"  value=\"" + arrayNames[j] + "\"/>";--}}
                            {{--newDiv.id = arrayNames[j];--}}
                            {{--form.append(newDiv);--}}
                            {{--newDiv.innerHTML = newInput;--}}
                        {{--}--}}
                    {{--}--}}
                {{--}--}}
                {{--if(j === 1){--}}
                    {{--console.log(x.length);--}}
                    {{--let name = arrayNames[j - 1];--}}
                    {{--if($('#' + name + '_' +arrayNames[j]).length === 0){--}}
                        {{--let newDiv = document.createElement("div");--}}
                        {{--let newInput =  "<label style=\"margin-left: 15px;\"" +--}}
                            {{--" for=\"" + name + "_" +arrayNames[j] + "\">" + arrayNames[j] + "</label>" +--}}
                            {{--"<input class=\"float-right " + name + "_" +arrayNames[j] + "\" id=\"" + name + "_" +arrayNames[j] +--}}
                            {{--"\" type=\"checkbox\" name=\"" + name + "_" +arrayNames[j] + "\"  value=\"" + name + "_" +arrayNames[j] + "\"/>";--}}
                        {{--newDiv.id = name + "_" + arrayNames[j];--}}
                        {{--newDiv.className = arrayNames[j - 1] + "_child";--}}
                        {{--newDiv.style.display = "none";--}}
                        {{--$( "." +  name ).after(newDiv);--}}
                        {{--newDiv.innerHTML = newInput;--}}
                    {{--}--}}
                {{--}--}}
                {{--if(j > 1){--}}
                    {{--console.log(x.length);--}}
                    {{--let currentName = "";--}}
                    {{--let parentName = "";--}}
                    {{--for (let n = j; n > -1; n--) {--}}
                        {{--if (n!=j) {--}}
                            {{--currentName += "_";--}}
                            {{--if(n!=0) {parentName += "_";}--}}
                        {{--}--}}
                        {{--if(n!=0){parentName += arrayNames[j - n];}--}}
                        {{--currentName += arrayNames[j - n];--}}
                    {{--}--}}
                    {{--let pixel = 15 * j;--}}
                    {{--if($('#' + currentName).length === 0){--}}
                        {{--let newDiv = document.createElement("div");--}}
                        {{--let newInput =  "<label style=\"margin-left: " + pixel + "px;\"" +--}}
                            {{--" for=\"" + currentName + "\">" + arrayNames[j] + "</label>" +--}}
                            {{--"<input class=\"float-right " + currentName + "\" id=\"" + currentName +--}}
                            {{--"\" type=\"checkbox\" name=\"" + currentName + "\"  value=\"" + currentName + "\"/>";--}}
                        {{--newDiv.id =  currentName;--}}
                        {{--newDiv.className = parentName + "_child";--}}
                        {{--newDiv.style.display = "none";--}}
                        {{--$( "." +  parentName ).after(newDiv);--}}
                        {{--newDiv.innerHTML = newInput;--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--}--}}

        {{--function updateDisplayCheckBoxes(id) {--}}
            {{--$("." + id + "_child").toggle();--}}
            {{--$("." + id + "_child input[type=checkbox]").prop( "checked", false );--}}
        {{--}--}}

        {{--$("#metric_form :input").change(function() {--}}
            {{--updateDisplayCheckBoxes(this.id);--}}
            {{--updateCheckBoxesCheck();--}}
        {{--});--}}

        {{--function updateCheckBoxesCheck() {--}}

            {{--$("#metric_form").data("changed",true);--}}
            {{--checkboxCheckChecked();--}}
            {{--function checkboxCheckChecked() {--}}
                {{--var allVals = [];--}}
                {{--$('#metric_form :checked').each(function() {--}}
                    {{--allVals.push($(this).val());--}}
                {{--});--}}

                {{--$.ajax({--}}
                    {{--method: 'POST',--}}
                    {{--url: '{{ route('ajax-metric-update') }}',--}}
                    {{--data: {'data' :  JSON.stringify(allVals)},--}}
                    {{--success: function(response){--}}
                        {{--console.log(response);--}}
                        {{--updateChart(response);--}}
                    {{--},--}}
                    {{--error: function(jqXHR, textStatus, errorThrown) {--}}
                        {{--console.log(jqXHR, textStatus, errorThrown);--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        {{--}--}}

        {{--var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];--}}
        {{--var config = {--}}
            {{--type: 'line',--}}
            {{--data: { labels: MONTHS, datasets: [] },--}}
            {{--options: {--}}
                {{--responsive: true,--}}
                {{--hover: {--}}
                    {{--mode: 'nearest',--}}
                    {{--intersect: true,--}}
                    {{--animationDuration: 0--}}
                {{--},--}}
                {{--animation: {--}}
                    {{--duration: 0--}}
                {{--},--}}
                {{--responsiveAnimationDuration: 0--}}
            {{--}--}}
        {{--};--}}

        {{--window.onload = function() {--}}
            {{--var ctx = document.getElementById('chart_line').getContext('2d');--}}
            {{--window.chartLine = new Chart(--}}
                {{--ctx,--}}
                {{--config--}}
            {{--);--}}
        {{--};--}}

        {{--function updateChart(dataResponse) {--}}
            {{--config.data.datasets = [];--}}
            {{--var updateChartObject = {};--}}
            {{--for(let i = 0; i < dataResponse.message.length; ++i){--}}
                {{--let color = "#xxxxxx".replace(/x/g, y=>(Math.random()*16|0).toString(16));--}}
                {{--updateChartObject['chart' + i] = {--}}
                    {{--label: dataResponse.message[i],--}}
                    {{--fill: false,--}}
                    {{--backgroundColor: color,--}}
                    {{--borderColor: color,--}}
                    {{--borderDash: [5, 5],--}}
                    {{--pointRadius: 10,--}}
                    {{--pointHoverRadius: 15,--}}
                    {{--showLine: false,--}}
                    {{--data: [--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41),--}}
                        {{--Math.floor(Math.random() * 41)--}}
                    {{--]--}}
                {{--};--}}
                {{--config.data.datasets.push(updateChartObject['chart' + i]);--}}
                {{--window.chartLine.update();--}}
            {{--}--}}
        {{--}--}}
    </script>
@endsection