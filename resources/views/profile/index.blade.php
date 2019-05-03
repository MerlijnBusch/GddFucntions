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

@forelse($story as $oneStory)

    <div class="card float-left" style="width: 18rem; height: 18rem; margin:5px 5px 10px 5px;">
        <div class="card-body">
            <h5 class="card-title">{{$oneStory->title}}</h5>
            <p class="card-text">

                    @if($oneStory->accepted == 'true')
                    <span class="badge badge-pill bg-success align-text-bottom">
                        accepted
                    </span>
                    @elseif($oneStory->accepted == 'declined')
                    <span class="badge badge-pill bg-danger align-text-bottom">
                        declined
                    </span>
                    @elseif($oneStory->accepted == 'false')
                    <span class="badge badge-pill bg-primary align-text-bottom">
                        still pending
                    </span>
                    @endif

            </p>
            <a href="{{route('story.edit',['story' => $oneStory->id])}}" class="card-link">Edit</a>
            <a href="{{route('story.share',['story' => $oneStory->id])}}" class="card-link">Share</a>
            <a href="" class="card-link"
               onclick="event.preventDefault();
               document.getElementById('delete_own_user_story_form').submit();">
            Delete</a>
            <form id="delete_own_user_story_form" action="{{ route('story.destroy',['story' => $oneStory->id]) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@empty

    <p>no stories found</p>

@endforelse

@endsection

@section('js')



@endsection