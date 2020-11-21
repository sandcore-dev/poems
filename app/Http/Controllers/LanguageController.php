<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Rules\ValidLanguageCode;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard.language.index')->with([
            'title' => __('Languages'),
            'languages' => Language::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard.language.form')->with([
            'title' => __('Add language'),
            'action' => route('dashboard.language.store'),
            'language' => new Language(),
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
            'code' => ['required', 'string', Rule::unique('languages', 'code'), new ValidLanguageCode()],
        ]);

        Language::create($request->only('code'));

        return redirect()->route('dashboard.language.index');
    }
}
