@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        <h1>@lang('Authors')</h1>

        {{ $authors->links() }}

        <table class="table-results">
            <thead>
            <tr>
                <th>
                    @lang('Name')
                </th>
                <th>
                    <a href="{{ route('dashboard.author.create') }}">
                        <span class="fa fa-plus"></span>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($authors as $author)
                <tr>
                    <td>
                        <a href="{{ route('dashboard.poem.index', ['author' => $author]) }}">
                            {{ $author->alphabetical_full_name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.author.edit', ['author' => $author]) }}">
                            <span class="fa fa-edit"></span>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        @lang('No authors found')
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $authors->links() }}
    </div>
@endsection

