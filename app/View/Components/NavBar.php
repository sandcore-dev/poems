<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
{
    public $show = false;

    /**
     * Create a new component instance.
     *
     * @param bool $show
     */
    public function __construct(bool $show = false)
    {
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.nav-bar');
    }
}
