@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-6">
                <input class="form-control" type="text" value="{{$sharedLink}}" id="copy_link" readonly>
            </div>
            <div class="col-md-3 col-sm-6">
                <button class="btn btn-info" onclick="copyLink()">Copy Link</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-sm-6">
                <input class="form-control" type="text" value="{{$hash}}" id="copy_hash"  readonly>
            </div>
            <div class="col-md-3 col-sm-6">
                <button class="btn btn-info" onclick="copyHash()">Copy Password</button>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    function copyLink() {
        let copyLink = document.getElementById("copy_link");
        copyLink.select();
        document.execCommand("copy");
        alert("Pasted towards clickboard: " + copyLink.value);
    }
    
    function copyHash() {
        let copyHash = document.getElementById("copy_hash");
        copyHash.select();
        document.execCommand("copy");
        alert("Pasted towards clickboard: " + copyHash.value);
    }
</script>
@endsection
