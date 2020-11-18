@extends('layouts.app')

@section('content')
    <x-centered-content>
        <div>
            <form class="form form-block" action="{{ route('confirmed') }}" method="post">
                @csrf
                <div>
                    <label>
                        @lang('Do you really want to log out?')
                    </label>
                </div>
                <div class="buttons">
                    <button type="submit">
                        @lang('Yes')
                    </button>

                    <a class="btn" href="{{ route('dashboard.index') }}">@lang('No')</a>
                </div>
            </form>
        </div>
    </x-centered-content>
@endsection
