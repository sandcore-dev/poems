<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function index(): Renderable
    {
        return view('home')
            ->with([
                'poem' => Poem::with(['author', 'stanzas.lines'])
                    ->inRandomOrder()
                    ->first(),
            ]);
    }
}
