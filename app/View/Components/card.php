<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    public $title;
    public $content;
    public $items;
    public function __construct($title , $content , $items)
    {
        $this->title = $title;
        $this->content = $content;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
