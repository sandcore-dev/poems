<?php

namespace App\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class NavBar extends Component
{
    public $show = false;
    public $searchFormAutofocus = false;

    /**
     * Create a new component instance.
     *
     * @param bool $show
     * @param bool $searchFormAutofocus
     */
    public function __construct(bool $show = false, bool $searchFormAutofocus = false)
    {
        $this->show = $show;
        $this->searchFormAutofocus = $searchFormAutofocus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Renderable
     */
    public function render()
    {
        return view('components.nav-bar');
    }
}
