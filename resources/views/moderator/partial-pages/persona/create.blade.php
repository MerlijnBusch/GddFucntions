@extends('layouts.master')

@section('content')

<form>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Title:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="" name="" placeholder="Epic title...">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Story:</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="" name="" placeholder="Epic story..." rows="8"></textarea>
        </div>
    </div>
</form>

<div class="container-barchart horizontal flat">
    <h2>Horizontal, Flat</h2>
    <div class="progress-bar horizontal">
        <div class="progress-track">
            <div class="progress-fill">
                <span>70%</span>
            </div>
        </div>
    </div>

    <div class="progress-bar horizontal">
        <div class="progress-track">
            <div class="progress-fill">
                <span>75%</span>
            </div>
        </div>
    </div>
</div>

<div id="container-barchart" class="container-barchart horizontal flat">
    <h2>Horizontal, Flat</h2>
    <div class="progress-bar horizontal">
        <div class="progress-track">
            <div class="progress-fill">
                <span>70%</span>
            </div>
        </div>
    </div>

    <div class="progress-bar horizontal">
        <div class="progress-track">
            <div class="progress-fill">
                <span>75%</span>
            </div>
        </div>
    </div>
</div>

<br>
<div>
    <div id="persona_create_process_bar" class="card" style="display: block;">
        <br>
        <div class="form-group row">
            <label for="persona_title" class="col-sm-2 col-form-label" style="margin-left: 15px"><b>Title Chart:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="persona_title" name="persona_title" placeholder="Epic title...">
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div id="bar_chart_persona">

        </div>
        <div class="form-group" style="overflow: hidden">
            <button id="persona_submit" class="btn-sm btn-success"  style="float: right">Submit</button>
            <button id="persona_add_extra_bar" class="btn-sm btn-warning"  style="float: right">Add Extra Bar</button>
        </div>
    </div>
    <br>
</div>
@endsection

@section('js')
<script>
    const Slider = function createSliderInput(LabelId, RangeId, idToAppendTo) {
        let sliderLabelId = "Label" + LabelId;
        let inputRangeId = "Slider" + RangeId;
        let htmlBar = "<hr><div class=\"form-group row\">" +
            "    <div class=\"col-sm-2\"><p style=\"margin-left: 15px\">Bar title:</p></div>" +
            "    <div class=\"col-sm-4\">" +
            "        <input type=\"text\" id=\"barTitle" + sliderLabelId + "\" class=\"form-control\" style=\"margin-left: 15px\" placeholder=\"Bar title\">" +
            "    </div>" +
            "    <div class=\"col-sm-6\"></div>" +
            "</div>" +
            "<div class=\"form-group row\"> " +
            "<label class=\"col-sm-2 col-form-label\" for=\"startSlider1\"  style=\"margin-left: 15px\">Value: <span id=\"sliderLabelId" + sliderLabelId + "\"></span></label> " +
            "<div class=\"col-sm-9\"> " +
            "    <input id=\"inputRangeId" + inputRangeId + "\" type=\"range\" class=\"custom-range\" min=\"0\" max=\"100\"> " +
            "</div> " +
            "<div class=\"col-sm-1\"></div> " +
            "</div>";

        $("#" + idToAppendTo ).append(htmlBar);
        let slider = document.getElementById("inputRangeId"+inputRangeId);
        let output = document.getElementById("sliderLabelId"+sliderLabelId);

        output.innerHTML = slider.value;
        slider.oninput = function () {
            output.innerHTML = this.value;
        };
    };

    $( "#persona_create_process_button" ).click(function() {
        $( "#persona_create_process_bar" ).toggle( "slow", function() {});
    });

    var k = 1;
    $( "#persona_add_extra_bar" ).click(function() {
        Slider(k,k,'bar_chart_persona');
        k++;
    });

    var allDataArray = [];
    $( "#persona_submit" ).click(function() {
        allDataArray = [];
        var personaTitle = $('#persona_title').val();
        var barTitleArray = [].slice.call(document.querySelectorAll('[id^=barTitle]'));
        var inputRangeIdArray = [].slice.call(document.querySelectorAll('[id^=inputRangeId]'));
        var titleObj = {titlePersona : personaTitle};
        allDataArray.push(titleObj);
        for(let i = 0; i < barTitleArray.length; i++){
            var tmpObj = {
                bar: {
                    "barTitle": barTitleArray[i].value,
                    "percentage": parseInt(inputRangeIdArray[i].value),
                }
            };
            allDataArray.push(tmpObj);
        }
        console.log(allDataArray)
    });

    $('.horizontal .progress-fill span').each(function(){
        var percent = $(this).html();
        $(this).parent().css('width', percent);
    });
</script>
@endsection