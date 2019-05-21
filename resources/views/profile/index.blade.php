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
            @include('profile.partials.links')
        </div>
    </div>
@empty

    <p>no stories found</p>

@endforelse
{{ $story->links() }}
@endsection

@section('js')



@endsection