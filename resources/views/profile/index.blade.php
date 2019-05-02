@extends('layouts.master')

@section('css')

    {{--//--}}

@endsection

@section('jumbotron')

    {{--//--}}

@endsection

@section('sidebar')



@endsection

@section('content')

{{$user->name}}
@forelse($story as $story)
    {{$story->title}}<br>
    {{$story->body}}
    <br>
    <br>
@empty

    <p>no stories found</p>

@endforelse

@endsection

@section('js')



@endsection