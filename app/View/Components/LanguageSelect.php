<?php

namespace App\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class LanguageSelect extends Component
{
    /**
     * @var string|null
     */
    public $label;

    /**
     * @var string|null
     */
    public $languageId;

    /**
     * Create a new component instance.
     *
     * @param string|null $label
     * @param int|null $languageId
     */
    public function __construct(string $label = null, int $languageId = null)
    {
        $this->label = $label;
        $this->languageId = $languageId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Renderable
     */
    public function render()
    {
        return view('components.language-select');
    }
}
