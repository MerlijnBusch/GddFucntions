@extends('layouts.master')

@section('title')
    @yield('title')
@endsection

@section('css')
    <link href="{{asset('css/minimal.css')}}" rel="stylesheet">
@endsection


@section('content_with_out_sidebar')
    <div class="flex-center position-ref full-height">
        <div class="code">
            @yield('code')
        </div>

        <div class="message" style="padding: 10px;">
            @yield('message')
        </div>
    </div>

@endsection
