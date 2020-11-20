<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Rules\UniqueAuthorFullName;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $authors = Author::search($search)
            ->paginate()
            ->appends(['search' => $search]);

        return view('dashboard.author.index')->with([
            'authors' => $authors,
            'autofocus' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard.author.form')->with([
            'action' => route('dashboard.author.store'),
            'author' => new Author(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['nullable', 'string', Rule::in(config('poems.title.options'))],
            'first_name' => ['required', 'string'],
            'middle_names' => ['nullable', 'string'],
            'last_name' => ['required', 'string', new UniqueAuthorFullName($request)],
            'birth_year' => ['nullable', 'date_format:Y'],
            'deceased_year' => ['nullable', 'date_format:Y'],
            'slug' => ['nullable', 'string', Rule::unique('authors', 'slug')],
        ]);

        $this->castInputToString($request);

        $author = Author::create($request->only([
            'title',
            'first_name',
            'middle_names',
            'last_name',
            'birth_year',
            'deceased_year',
            'slug',
        ]));

        return redirect()->route('dashboard.poem.index', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return Renderable
     */
    public function edit(Author $author)
    {
        return view('dashboard.author.form')->with([
            'action' => route('dashboard.author.update', ['author' => $author]),
            'method' => 'PUT',
            'header' => __("Edit author ':name'", ['name'  => $author->full_name]),
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'title' => ['nullable', 'string', Rule::in(config('poems.title.options'))],
            'first_name' => ['required', 'string'],
            'middle_names' => ['nullable', 'string'],
            'last_name' => ['required', 'string', (new UniqueAuthorFullName($request))->ignore($author)],
            'birth_year' => ['nullable', 'date_format:Y'],
            'deceased_year' => ['nullable', 'date_format:Y'],
            'slug' => ['nullable', 'string', Rule::unique('authors', 'slug')->ignore($author)],
        ]);

        $this->castInputToString($request);

        $author->update($request->only([
            'title',
            'first_name',
            'middle_names',
            'last_name',
            'birth_year',
            'deceased_year',
            'slug',
        ]));

        return redirect()->route('dashboard.poem.index', ['author' => $author]);
    }

    protected function castInputToString(Request $request)
    {
        foreach(['title', 'middle_names'] as $field) {
            if ($request->isNotFilled($field)) {
                $request->merge([
                    $field => '',
                ]);
            }
        }
    }
}
