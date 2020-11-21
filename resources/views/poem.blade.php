<article class="poem" lang="{{ $poem->language->code }}">
    <header>
        <h1 class="title">{{ $poem->title }}</h1>
    </header>
    <div class="contents">
        @foreach($poem->stanzas as $stanza)
            <div class="stanza">
                @parsedown($stanza->text)
            </div>
        @endforeach
    </div>
    <footer>
        <address>
            {{ $poem->author->full_name }}
        </address>
    </footer>
</article>

