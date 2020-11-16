@extends('layouts.app')

@section('content')
    <x-centered-content>
            <form class="form" action="{{ route('authenticate') }}" method="post">
                @csrf
                <div>
                    <label for="email">
                        @lang('E-mail address')
                    </label>
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="user@domain.tld"
                        autocomplete="email"
                        autofocus
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password">
                        @lang('Password')
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="********"
                        autocomplete="current-password"
                    />
                    @error('password')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="buttons">
                    <button type="submit">
                        @lang('Sign in')
                    </button>

                    <a class="btn" href="{{ route('home') }}">@lang('Cancel')</a>
                </div>
            </form>
    </x-centered-content>
@endsection
