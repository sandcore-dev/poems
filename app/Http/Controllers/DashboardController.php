<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Line;
use App\Models\Poem;
use App\Models\Stanza;
use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        return view('dashboard.index')->with([
            'authors' => Author::count(),
            'poems' => Poem::count(),
            'stanzas' => Stanza::count(),
            'lines' => Line::count(),
        ]);
    }
}
