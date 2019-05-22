nav
<a href="{{route('metric.index')}}">metric</a>
<a href="{{route('story.index')}}">story</a>
@if(auth()->check())
<a href="{{ route('user_profile',auth()->user()) }}">My Profile</a>
    @if(auth()->user()->type === 'moderator')
        <a href="{{route('moderator.index')}}">moderator</a>
    @endif
@if(auth()->user()->type === 'admin')
    <a href="{{route('admin.index')}}">admin</a>
@endif
@endif