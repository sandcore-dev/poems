<div class="navbar {{ $show ? 'show' : '' }}">
    <nav>
        @guest
            <div class="text-right">
                <a class="btn" href="{{ route('login') }}">@lang('Login')</a>
            </div>
        @else
            <div class="grid grid-cols-2">
                <div>
                    <a class="btn" href="{{ route('dashboard.index') }}">@lang('Dashboard')</a>
                </div>
                <div class="text-right">
                    <a class="btn" href="{{ route('logout') }}">@lang('Logout')</a>
                </div>
            </div>
        @endguest
    </nav>
</div>

