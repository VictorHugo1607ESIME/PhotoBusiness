<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnEdit extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public $url;
    public function __construct($url=null)
    {
        $this->url = $url;
    }
    public function render()
    {
        return view('components.btn-edit');
    }
}
