<?php

namespace App\View\Components;

use Illuminate\View\Component;

class updated extends Component
{
    public $date;
    public $name;
    public $id;
    public function __construct($date,$name = null, $id=null)
    {
        $this->date = $date->diffForHumans();
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.updated');
    }
}
