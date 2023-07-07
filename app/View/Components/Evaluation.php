<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Evaluation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $evaluation;

    public function __construct ($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.evaluation');
    }
}
