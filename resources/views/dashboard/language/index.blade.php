@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        <h1>{{ $title }}</h1>

        <div class="text-center">
            <a class="btn" href="{{ route('dashboard.language.create') }}">
                @lang('Add language')
            </a>
        </div>

        {{ $languages->links() }}

        <table class="table-results">
            <thead>
            <tr>
                <th>
                    @lang('Language')
                </th>
                <th>
                    @lang('Code')
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($languages as $language)
                <tr>
                    <td>
                        {{ $language->name }}
                    </td>
                    <td>
                        {{ $language->code }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        @lang('No languages found')
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $languages->links() }}
    </div>
@endsection
