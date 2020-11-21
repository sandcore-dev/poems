@extends('layouts.app')

@section('content')
    <x-centered-content>
        <form class="form" action="{{ $action }}" method="post">
            @csrf
            @method($method ?? 'POST')

            <h1>{{ $title }}</h1>

            <div class="grid grid-flow-col auto-cols-auto">
                <div class="mr-2">
                    <label for="title">
                        @lang('Title')
                    </label>
                    <select id="title" name="title" autofocus>
                        <?php $title = $title ?? ''; ?>
                        @foreach(config('poems.title.options') as $option)
                            <option{{ old('title', $author->title) === $option ? ' selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('title')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="first_name">
                        @lang('First name')
                    </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name', $author->first_name) }}"
                    />
                </div>
                @error('first_name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="middle_names">
                    @lang('Middle names')
                </label>
                <input
                    type="text"
                    id="middle_names"
                    name="middle_names"
                    value="{{ old('middle_names', $author->middle_names) }}"
                />
                @error('middle_names')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="last_name">
                    @lang('Last name')
                </label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name', $author->last_name) }}"
                />
                @error('last_name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="birth_year">
                        @lang('Birth year')
                    </label>
                    <input
                        type="text"
                        id="birth_year"
                        name="birth_year"
                        value="{{ old('birth_year', $author->birth_year) }}"
                        maxlength="4"
                    />
                    @error('birth_year')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="deceased_year">
                        @lang('Deceased year')
                    </label>
                    <input
                        type="text"
                        id="deceased_year"
                        name="deceased_year"
                        value="{{ old('deceased_year', $author->deceased_year) }}"
                        maxlength="4"
                    />
                    @error('deceased_year')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div>
                <label for="slug">
                    @lang('Slug')
                </label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug', $author->slug) }}"
                />
                @error('slug')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <x-language-select :label="__('Primary language')" :language-id="$author->language->id"></x-language-select>
            <div class="buttons">
                <button type="submit">
                    @lang(isset($method) && $method === 'PUT' ? 'Edit' : 'Add')
                </button>

                <a class="btn" href="{{ route('dashboard.author.index') }}">
                    @lang('Back to index')
                </a>
            </div>
        </form>
    </x-centered-content>
@endsection
