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
    public $alt;
    public $id;
    public $btnPrincipal;
    public $idPrincipal;
    public $key;
    public function __construct($key=null,$url,$id,$alt=null,$btnPrincipal=false ,$idPrincipal=0)
    {
        $this->key=$key;
        $this->url=$url;
        $this->path=$path;
        $this->id=$id;
        $this->btnPrincipal=$btnPrincipal;
        $this->idPrincipal=$idPrincipal;
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
