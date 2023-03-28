<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardCount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $color;
    public $count;
    public $title;
    public function __construct($color, $count, $title)
    {
        $this->color = $color;
        $this->count = $count;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-count');
    }
}
