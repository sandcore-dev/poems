<form class="form form-inline" action="{{ route('dashboard.author.index') }}" method="get">
    <div>
        <label>
            <input type="text" name="search"{{ $autofocus ? ' autofocus' : '' }}/>
        </label>
    </div>
    <div class="buttons">
        <button type="submit">
            @lang('Search')
        </button>
    </div>
</form>
