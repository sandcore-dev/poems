<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Poem;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PoemController extends Controller
{
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
            'action' => route('dashboard.poem.store', ['author' => $author]),
            'author' => $author,
            'poem' => new Poem(),
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
            'text' => ['required', 'string'],
        ]);

        /** @var Poem $poem */
        $poem = $author->poems()->create($request->only('title', 'slug'));
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
            'text' => ['required', 'string'],
        ]);

        $poem->update($request->only('title', 'slug'));
        $poem->saveText($request->input('text'));

        return redirect()->route('dashboard.poem.show', ['author' => $author, 'poem' => $poem]);
    }
}
