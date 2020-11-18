@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        <h1>@lang('Poems by :name', ['name' => $author->full_name])</h1>

        <div class="text-center">
            <a class="btn" href="{{ route('dashboard.author.index') }}">
                @lang('Back to index')
            </a>
        </div>

        {{ $poems->links() }}

        <table class="table-results">
            <thead>
            <tr>
                <th>
                    @lang('Name')
                </th>
                <th>
                    <a href="{{ route('dashboard.poem.create', ['author' => $author]) }}">
                        <span class="fa fa-plus"></span>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($poems as $poem)
                <tr>
                    <td>
                        <a href="{{ route('dashboard.poem.show', ['author' => $author, 'poem' => $poem]) }}">
                            {{ $poem->title }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.poem.edit', ['author' => $author, 'poem' => $poem]) }}">
                            <span class="fa fa-edit"></span>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        @lang('No poems found')
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $poems->links() }}
    </div>
@endsection

