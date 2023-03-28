<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data = array())
    {
        $this->data = $data;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->data);
        return view('components.breadcumb')->with('data', $this->data);
    }
}
