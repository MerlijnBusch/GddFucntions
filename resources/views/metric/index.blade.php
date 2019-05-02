@extends('layouts.master')

@section('css')

    <link href="{{ asset('css/metric.css') }}" rel="stylesheet">

@endsection

@section('jumbotron')
    <div class="jumbotron jumbotron-fluid box--shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-3">
                    <h1>GGD LOGO INSERT</h1>
                </div>
                <div class="col-12 col-md-7">
                    <div id="already-made-stories">
                        <h1 class="display-4">Stories</h1>
                        <p class="lead">Lorem Ipsum is just a sample
                            text from the printing and typesetting
                            industry. Lorem Ipsum has been the standard
                            sample text in this industry since the
                            16th century, when an unknown printer
                            took a brewing hook with letters and
                            mixed them up to make a font catalog.
                            It has not only survived five centuries
                            but has also, virtually unchanged, been
                            copied in electronic letter setting.
                            It became popular in the 60s with the
                            introduction of Letraset sheets with Lorem
                            Ipsum passages and more recently with
                            desktop publishing software such as
                            Aldus PageMaker containing versions of Lorem Ipsum.
                        </p>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="float-left">
                        <h1 onclick="toggleShareStory()">SHARE STORY</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('sidebar')

    <h1>Comparing metric</h1>

    <form id="metric_form">
        {{--@csrf--}}
        <div class="form-group">
            <label for="exampleFormControlSelect1">Main Metric</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        @include('metric.metric-selection-partials.comparative_metric')

        <div class="form-group">
            <p>Subgroups</p>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        1.  Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        2. Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">
                        3. Default checkbox
                    </label>
                </div>
            </div>
        </div>

        @include('metric.metric-selection-partials.age')
        @include('metric.metric-selection-partials.view')
    </form>
@endsection

@section('content')

    <div class="button_toggle">
        <div class="float-left"><button class="btn btn-success btn-sm button_toggle_dataviz" onclick="toggle_toMap()">Map</button></div>
        <div class="float-left"><button class="btn btn-success btn-sm button_toggle_dataviz" onclick="toggle_toDataviz()">Dataviz</button></div>
    </div>

    @include('metric.partials.map')

    @include('metric.partials.chart')

    @include('metric.partials.shareStory')

@endsection

@section('js')
    <script src="{{asset('js/ToggleDisplay.js')}}"></script>
    <script src="{{asset('js/metric.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#metric_form :input").change(function() {
            $("#metric_form").data("changed",true);
            console.log("changed");
            checkboxCheckChecked();
            function checkboxCheckChecked() {
                var allVals = [];
                $('#metric_form :checked').each(function() {
                    allVals.push($(this).val());
                });
                $.ajax({
                    method: 'POST', // Type of response and matches what we said in the route
                    url: '{{ route('ajax-metric-update') }}', // This is the url we gave in the route
                    data: {'data' :  JSON.stringify(allVals)}, // a JSON object to send back
                    success: function(response){ // What to do if we succeed
                        console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(jqXHR, textStatus, errorThrown);
                    }
                });
            }
        });
    </script>
    <script>
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: true
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        });

        $(".checkbox-story-submit").change(function() {
            let storyMetricStore = [];
            $('#metric_form :checked').each(function() {
                storyMetricStore.push($(this).val());
            });
            let dataBaseReady = JSON.stringify(storyMetricStore);
            if(this.checked) {
                $('input[name=story_add_metric_to_story_hidden]').val(dataBaseReady);
            } else if(!this.checked){
                $('input[name=story_add_metric_to_story_hidden]').val('');
            }
        });

        function submit_form() {
            let about = document.querySelector('input[name=about]');
            about.value = quill.root.innerHTML;
            $('input[name=story_add_body_to_story_hidden_json]').val(JSON.stringify(quill.getContents()));
            document.getElementById('form_make_story').submit();
        }
    </script>
@endsection