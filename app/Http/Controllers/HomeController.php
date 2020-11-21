<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): Renderable
    {
        $usedPoemIds = $request->session()->get('used_poem_ids', []);
        if (count($usedPoemIds) >= Poem::count()) {
            $usedPoemIds = [];
        }

        /** @var Poem $poem */
        $poem = Poem::with(['author', 'stanzas.lines'])
            ->whereNotIn('id', $usedPoemIds)
            ->inRandomOrder()
            ->first();

        $usedPoemIds[] = $poem->id;
        $request->session()->put('used_poem_ids', $usedPoemIds);

        return view('home')
            ->with([
                'title' => "{$poem->title} - {$poem->author->full_name_with_years}",
                'poem' => $poem,
            ]);
    }
}
