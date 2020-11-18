@extends('layouts.app')

@section('content')
    <x-centered-content>
        <div class="w-full md:w-3/4 xl:w-1/2">
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
                            <td>{{ $author->alphabetical_full_name }}</td>
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
    </x-centered-content>
@endsection

