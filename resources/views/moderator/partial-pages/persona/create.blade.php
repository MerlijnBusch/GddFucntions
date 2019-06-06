@extends('layouts.master')

@section('css')

    <link href="{{asset('css/masonry.css')}}" rel="stylesheet">

@endsection

@section('content_with_out_sidebar')

<form id="form_persona_submit" method="post" action="{{route('moderator.persona.store')}}">
    @csrf
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Title:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="persona_title_form" name="persona_title_form" placeholder="Epic title..." required>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Story:</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="persona_body_form" name="persona_body_form" placeholder="Epic story..." rows="8" required></textarea>
        </div>
    </div>
    <input type="hidden" name="json_data_bar_charts" id="json_data_bar_charts">
    <div id="persona_chart" class="masonry">

    </div>
    <a class="btn btn-success" id="submit_make_persona_form">Submit Persona</a>
</form>

<br>
<div>
    <div id="persona_create_process_bar" class="card" style="display: block;">
        <br>
        <div class="form-group row">
            <label for="persona_title" class="col-sm-2 col-form-label" style="margin-left: 15px"><b>Title Chart:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="persona_title" name="persona_title" placeholder="Epic title..." required>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div id="bar_chart_persona">

        </div>
        <div class="form-group" style="overflow: hidden">
            <button id="persona_submit" class="btn-sm btn-success"  style="float: right">Submit</button>
            <button id="persona_delete_bar" class="btn-sm btn-danger"  style="float: right">Delete A bar</button>
            <button id="persona_add_extra_bar" class="btn-sm btn-warning"  style="float: right">Add Extra Bar</button>
        </div>
    </div>
    <br>
</div>
@endsection

@section('js')
<script>
    var mainArrayAllData = [];

    const Slider = function createSliderInput(LabelId, RangeId, idToAppendTo) {
        let sliderLabelId = "Label" + LabelId;
        let inputRangeId = "Slider" + RangeId;
        let htmlBar = "<div id=\"wrapperOf" + RangeId + "\">" +
            "<hr><div class=\"form-group row\">" +
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
            "</div>" +
            "</div>";

        $("#" + idToAppendTo ).append(htmlBar);
        let slider = document.getElementById("inputRangeId"+inputRangeId);
        let output = document.getElementById("sliderLabelId"+sliderLabelId);

        output.innerHTML = slider.value;
        slider.oninput = function () {
            output.innerHTML = this.value;
        };
    };

    const chart = function createBarChart(ArrayData){
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
        $("#persona_chart").append(html);
        $('.horizontal .progress-fill span').each(function(){
            var percent = $(this).html();
            $(this).parent().css('width', percent);
        });
    };

    $( "#persona_create_process_button" ).click(function() {
        $( "#persona_create_process_bar" ).toggle( "slow", function() {});
    });

    $( "#persona_delete_bar" ).click(function() {
        var lastChild = document.getElementById("bar_chart_persona").lastChild;
        $("#"+lastChild.id).remove();
    });

    var k = 1;
    $( "#persona_add_extra_bar" ).click(function() {
        Slider(k,k,'bar_chart_persona');
        k++;
    });

    $( "#submit_make_persona_form" ).click(function() {
        $("#json_data_bar_charts").val(JSON.stringify(mainArrayAllData));
        document.getElementById("form_persona_submit").submit();
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
        mainArrayAllData.push(allDataArray);
        chart(allDataArray);
    });
</script>
@endsection