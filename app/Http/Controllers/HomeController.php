<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function index(): Renderable
    {
        /** @var Poem $poem */
        $poem = Poem::with(['author', 'stanzas.lines'])
            ->inRandomOrder()
            ->first();

        return view('home')
            ->with([
                'title' => "{$poem->title} - {$poem->author->full_name}",
                'poem' => $poem,
            ]);
    }
}
