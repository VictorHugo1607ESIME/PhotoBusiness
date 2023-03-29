<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tables extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $titles;
    public $data;
    public function __construct($titles, $data)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables')->with('$titles', $this->data);
    }
}
