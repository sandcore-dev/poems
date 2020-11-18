<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Poem;
use Illuminate\Contracts\Support\Renderable;
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
        return view('dashboard.poem.create')->with([
            'author' => $author,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Author $author
     */
    public function store(Request $request, Author $author)
    {
        //
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
        return view('dashboard.poem.edit')->with([
            'author' => $author,
            'poem' => $poem,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Author $author
     * @param Poem $poem
     */
    public function update(Request $request, Author $author, Poem $poem)
    {
        //
    }
}
