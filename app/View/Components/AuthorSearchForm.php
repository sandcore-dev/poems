<?php

namespace App\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class AuthorSearchForm extends Component
{
    public $autofocus = false;

    /**
     * Create a new component instance.
     *
     * @param bool $autofocus
     */
    public function __construct(bool $autofocus = false)
    {
        $this->autofocus = $autofocus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Renderable
     */
    public function render()
    {
        return view('components.author-search-form');
    }
}
