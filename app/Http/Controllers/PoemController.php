<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Poem;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Author $author
     * @return Renderable
     */
    public function index(Author $author)
    {
        $author->loadMissing('poems');

        return view('dashboard.poem.index')->with([
            'title' => __('Poems by :name', ['name' => $author->full_name]),
            'author' => $author,
            'poems' => $author->poems()->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Author $author
     * @return Renderable
     */
    public function create(Author $author)
    {
        return view('dashboard.poem.form')->with([
            'title' => __('Add poem by :name', ['name' => $author->full_name]),
            'action' => route('dashboard.poem.store', ['author' => $author]),
            'author' => $author,
            'poem' => $author->poems()->make(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function store(Request $request, Author $author)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'language_id' => ['nullable', 'integer', 'exists:languages,id'],
            'text' => ['required', 'string'],
        ]);

        /** @var Poem $poem */
        $poem = $author->poems()->create($request->only('title', 'slug', 'language_id'));
        $poem->saveText($request->input('text'));

        return redirect()->route('dashboard.poem.show', ['author' => $author, 'poem' => $poem]);
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @param Poem $poem
     * @return Renderable
     */
    public function show(Author $author, Poem $poem)
    {
        return view('dashboard.poem.show')->with([
            'author' => $author,
            'poem' => $poem,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Author $author
     * @param Poem $poem
     * @return Renderable
     */
    public function edit(Author $author, Poem $poem)
    {
        return view('dashboard.poem.form')->with([
            'title' => __('Edit poem by :name', ['name' => $author->full_name]),
            'action' => route('dashboard.poem.update', ['author' => $author, 'poem' => $poem]),
            'method' => 'PUT',
            'author' => $author,
            'poem' => $poem,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Author $author
     * @param Poem $poem
     * @return RedirectResponse
     */
    public function update(Request $request, Author $author, Poem $poem)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'language_id' => ['nullable', 'integer', 'exists:languages,id'],
            'text' => ['required', 'string'],
        ]);

        $poem->update($request->only('title', 'slug', 'language_id'));
        $poem->saveText($request->input('text'));

        return redirect()->route('dashboard.poem.show', ['author' => $author, 'poem' => $poem]);
    }
}
