<nav class="navbar_backcolor">
    <div class="container">
        <div class="navbar_ggd">
            <div class="navbar_ggd-logo">
                <a href="{{ url('/') }}">
                    <img src="{{asset('images/logo.png')}}" alt="GGD logo" class="navbar_ggd-logo">
                </a>
            </div>
            <div class="navbar_ggd-links">
                <ul class="navbar_ul">
                    <li class="nav-item navbar_li">
                        <a class="nav-link" href="{{route('metric.index')}}">Metric</a>
                    </li>
                    <li class="nav-item navbar_li">
                        <a class="nav-link" href="{{route('story.index')}}">Story</a>
                    </li>
                    @guest
                        <li class="nav-item navbar_li">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item navbar_li">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if(auth()->user()->type === 'moderator')
                            <li class="nav-item navbar_li">
                                <a class="nav-link" href="{{route('moderator.index')}}">Moderator</a>
                            </li>
                        @endif
                        @if(auth()->user()->type === 'admin')
                            <li class="nav-item navbar_li">
                                <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
                            </li>
                        @endif
                        <li class="nav-item navbar_li">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                        <li class="nav-item navbar_li">
                            <a class="nav-link" href="{{ route('user_profile',auth()->user()) }}">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>