@extends('layouts.master')

@section('content_with_out_sidebar')

    <form>
        <h3>{{$metric->file_name}}</h3>
        <div id="labels_for_data">

            <br>
        </div>
        <div id="data_preview_metric">

        </div>
        <button onclick="update()" type="button">Submit</button>
    </form>

@endsection

@section('js')
    <script>
        var data;

        init();
        function init() {
            var json_data = '{{$metric->data_json_version}}';
            let json_data_replaced = json_data.replace(/&quot;/g, '"');
            try {
                data = JSON.parse(json_data_replaced);
                console.log(data);
                displayData();
            } catch (error) {
                console.error(error);
            }
        }

        function displayData() {
            for(let i = 0; i < data.length; ++i){
                let names = Object.keys(data[i]);
                console.log('----------');
                console.log(i);
                console.log(names);
                console.log('----------');
                for(let j = 0; j < names.length; ++j){
                    let vw = 90 / names.length;
                    console.log(j);
                    let a = document.createElement("input");
                    let c = document.createElement("input");
                    let b = names[j];
                    c.setAttribute('type', 'text');
                    c.style.width = vw + 'vw';
                    c.setAttribute('value', names[j]);
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
                        console.log("Last iteration with item");
                    }
                }
            }
        }

        function update() {
            console.log('update')
        }

    </script>
@endsection