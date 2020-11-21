<div class="navbar {{ $show ? 'show' : '' }}">
    <nav>
        @guest
            <div class="text-right">
                <a class="btn" href="{{ route('login') }}">@lang('Login')</a>
            </div>
        @else
            <div class="grid grid-cols-3">
                <div>
                    <a class="btn" href="{{ route('home') }}">@lang('Home')</a>
                    <a class="btn" href="{{ route('dashboard.index') }}">@lang('Dashboard')</a>
                    <a class="btn" href="{{ route('dashboard.language.index') }}">@lang('Languages')</a>
                </div>
                <div class="text-center">
                    <x-author-search-form :autofocus="$searchFormAutofocus"></x-author-search-form>
                </div>
                <div class="text-right">
                    <a class="btn" href="{{ route('logout') }}">@lang('Logout')</a>
                </div>
            </div>
        @endguest
    </nav>
</div>

