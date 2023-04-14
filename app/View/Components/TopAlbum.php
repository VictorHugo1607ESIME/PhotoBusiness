<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TopAlbum extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $number;
    public $id;
    public function __construct($id, $number)
    {
        $this->id = $id;
        $this->number = $number;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.top-album');
    }
}
