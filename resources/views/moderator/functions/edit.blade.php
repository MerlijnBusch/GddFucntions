@extends('layouts.master')

@section('content_with_out_sidebar')

    <form method="post" action="{{route('moderator.update.cvs_to_json')}}" id="csv_form_update">
        @csrf
        @method('PUT')
        <h3>{{$metric->file_name}}</h3>
        <input type="hidden" id="form_title_csv_edit" name="form_title_csv_edit" value="{{$metric->file_name}}">
        <input type="hidden" id="json_stringify_edit_csv" name="json_stringify_edit_csv">
        <div id="labels_for_data">
            <br>
        </div>
        <div id="data_preview_metric">
        </div>
        <button onclick="update()" type="submit">Submit</button>
    </form>

@endsection

@section('js')
    <script>
        var data;
        var names;

        init();
        function init() {
            var json_data = '{{$metric->data_json_version}}';
            let json_data_replaced = json_data.replace(/&quot;/g, '"');
            try {
                data = JSON.parse(json_data_replaced);
                displayData();
            } catch (error) {
                console.error(error);
            }
        }

        function displayData() {
            for(let i = 0; i < data.length; ++i){
                names = Object.keys(data[i]);
                for(let j = 0; j < names.length; ++j){
                    let vw = 90 / names.length;
                    let a = document.createElement("input");
                    let c = document.createElement("input");
                    let b = names[j];
                    c.setAttribute('type', 'text');
                    c.style.width = vw + 'vw';
                    c.setAttribute('value', names[j]);
                    c.setAttribute('id', 'start' + names[j]);
                    c.readOnly = true;
                    a.setAttribute('type', 'text');
                    a.style.width = vw + 'vw';
                    a.setAttribute('id', i + names[j]);
                    a.setAttribute('value', data[i][b]);
                    if(i === 0){document.getElementById("labels_for_data").appendChild(c);}
                    document.getElementById("data_preview_metric").appendChild(a);
                    if((j + 1) === (names.length)){
                        let br = document.createElement("br");
                        let next_sib = a.nextSibling;
                        if (next_sib) { document.getElementById('data_preview_metric').insertBefore(br, next_sib); }
                        else { document.getElementById('data_preview_metric').appendChild(br); }
                    }
                }
            }
        }

        function update() {
            var jsonArray = [];
            for(let i = 0; i < data.length; ++i){
                let names_length = Object.keys(data[i]);
                let main_obj = [];
                var newStr;
                for(let k = 0; k < names_length.length; ++k){
                    main_obj += '"' + names_length[k] + '":' + '"insert_data_here' + k + '",';
                    newStr = main_obj.substring(0, main_obj.length - 1);
                }
                var jsonString = '{'+newStr+'}';
                for(let j = 0; j < names_length.length; ++j) {
                    let a = document.getElementById(i + names_length[j]).value;
                    jsonString = jsonString.replace("insert_data_here" + j, a);
                }
                jsonArray.push(JSON.parse(jsonString));
            }
            document.getElementById('json_stringify_edit_csv').value = JSON.stringify(jsonArray);
            document.getElementById('csv_form_update').submit();
        }

    </script>
@endsection