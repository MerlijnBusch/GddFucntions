nav
<a href="{{route('metric.index')}}">metric</a>
<a href="{{route('story.index')}}">story</a>
@if(auth()->check())
<a href="{{ route('user_profile',auth()->user()) }}">My Profile</a>
@endif