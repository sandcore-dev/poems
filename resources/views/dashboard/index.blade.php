@extends('layouts.app')

@section('content')
    <x-centered-content>
        <div class="grid md:grid-cols-2 gap-2 w-full max-w-xl mx-auto">
            <div class="count">
                <header>
                    @number($authors)
                </header>
                <footer>
                    {{ trans_choice('author|authors', $authors) }}
                </footer>
            </div>
            <div class="count">
                <header>
                    @number($poems)
                </header>
                <footer>
                    {{ trans_choice('poem|poems', $poems) }}
                </footer>
            </div>
            <div class="count">
                <header>
                    @number($stanzas)
                </header>
                <footer>
                    {{ trans_choice('stanza|stanzas', $stanzas) }}
                </footer>
            </div>
            <div class="count">
                <header>
                    @number($lines)
                </header>
                <footer>
                    {{ trans_choice('line|lines', $lines) }}
                </footer>
            </div>
        </div>
    </x-centered-content>
@endsection
