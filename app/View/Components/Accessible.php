<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Accessible extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public int $accessible;

    public function __construct(bool $accessible)
    {
        $this->accessible = $accessible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.accessible');
    }
}
