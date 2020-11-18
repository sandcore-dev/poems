@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        @include('poem')
        <div class="text-center">
            <a class="btn" href="{{ route('dashboard.poem.index', ['author' => $author]) }}">
                @lang('Back to index')
            </a>
            <a class="btn" href="{{ route('dashboard.poem.edit', ['author' => $author, 'poem' => $poem]) }}">
                @lang('Edit poem')
            </a>
        </div>
    </div>
@endsection
