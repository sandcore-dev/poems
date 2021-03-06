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
        $this->middleware('auth:sanctum');
    }

    public function index(): Renderable
    {
        return view('dashboard.index')->with([
            'title' => __('Dashboard'),
            'authors' => Author::count(),
            'poems' => Poem::count(),
            'stanzas' => Stanza::count(),
            'lines' => Line::count(),
            'autofocus' => true,
        ]);
    }
}
