<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card-img extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;
    public $path;
    public function __construct($url,$path)
    {
        $this->url=$url;
        $this->path=$path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-img');
    }
}
