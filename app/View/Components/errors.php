<?php

namespace App\View\Components;

use Illuminate\View\Component;

class errors extends Component
{
    public $myClass;
    public function __construct($myClass='danger')
    {
        $this->myClass = $myClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.errors');
    }
}
