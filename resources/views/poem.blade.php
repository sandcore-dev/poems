<article class="poem">
    <header>
        <h1 class="title">{{ $poem->title }}</h1>
    </header>
    <div class="contents">
        @foreach($poem->stanzas as $stanza)
            <p class="stanza">
                @foreach($stanza->lines as $line)
                    {{ $line->content }}<br>
                @endforeach
            </p>
        @endforeach
    </div>
    <footer>
        <address>
            {{ $poem->author->full_name_with_years }}
        </address>
    </footer>
</article>

