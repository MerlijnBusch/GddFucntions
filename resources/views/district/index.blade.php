@extends('layouts.master')

@section('content_with_out_sidebar')
<div class="container">
    <div class="border-bottom border-dark" style="overflow: hidden">
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Totaal" style="margin: 2px 2px 2px 2px">Totaal</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Centrum" style="margin: 2px 2px 2px 2px">Centrum</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="West" style="margin: 2px 2px 2px 2px">West</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Nieuw-West" style="margin: 2px 2px 2px 2px">Nieuw-West</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Zuid" style="margin: 2px 2px 2px 2px">Zuid</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Oost" style="margin: 2px 2px 2px 2px">Oost</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Noord" style="margin: 2px 2px 2px 2px">Noord</button>
        <button class="btn btn-lg btn-primary float-left" onclick="requestData(this)" name="Zuidoost" style="margin: 2px 2px 2px 2px">Zuidoost</button>
    </div>
    <div id="displayDataDiv">

    </div>
</div>
@endsection

@section('js')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function requestData(id){
        setTimeout(function(){
            $.ajax({
                method: 'POST',
                url: '{{ route('district.ajax-request-data') }}',
                data: {'data' :  id.name},
                success: function(response){
                    console.log(response);
                    showData(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        }, 50);
    }

    function showData(data){

    }

</script>
@endsection
