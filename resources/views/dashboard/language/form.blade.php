@extends('layouts.app')

@section('content')
    <x-centered-content>
        <form class="form" action="{{ $action }}" method="post">
            @csrf
            @method($method ?? 'POST')

            <h1>{{ $title }}</h1>

            <div>
                <label for="code">
                    @lang('Code')
                </label>
                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code', $language->code) }}"
                    autofocus
                />
                @error('code')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="buttons">
                <button type="submit">
                    @lang(isset($method) && $method === 'PUT' ? 'Edit' : 'Add')
                </button>

                <a class="btn" href="{{ route('dashboard.language.index') }}">
                    @lang('Back to index')
                </a>
            </div>
        </form>
    </x-centered-content>
@endsection
