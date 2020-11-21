@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        <form class="form" action="{{ $action }}" method="post">
            @csrf
            @method($method ?? 'POST')

            <h1>{{ $title }}</h1>

            <div class="grid grid-flow-col auto-cols-auto gap-2">
                <div>
                    <label for="title">
                        @lang('Title')
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $poem->title) }}"
                        autofocus
                    />
                    @error('title')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="slug">
                        @lang('Slug')
                    </label>
                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        value="{{ old('slug', $poem->slug) }}"
                    />
                    @error('slug')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div>
                <label for="text">
                    @lang('Text')
                </label>
                <textarea id="text" name="text" class="min-h-50">{{ old('text', $poem->text) }}</textarea>
                @error('text')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="buttons">
                <button type="submit">
                    @lang(isset($method) && $method === 'PUT' ? 'Edit' : 'Add')
                </button>

                <a class="btn" href="{{ route('dashboard.poem.index', ['author' => $author]) }}">
                    @lang('Back to index')
                </a>
            </div>
        </form>
    </div>
@endsection
