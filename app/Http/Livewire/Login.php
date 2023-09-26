<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $type;
    public $recipientPass;
    public $recipientEmail;
    public $button;
    public function mount()
    {
        $this->type = "password";
        $this->recipientEmail = "";
        $this->recipientPass = "";
        $this->button='<i class="fa-solid fa-eye"></i>';
    }
    public function render()
    {
        return view('livewire.login');
    }
    public function changeType()
    {
        if ($this->type == "text") {
            $this->type = "password";
            $this->button='<i class="fa-solid fa-eye"></i>';
        } else {
            $this->type = "text";
            $this->button='<i class="fa-solid fa-eye-slash"></i>';
        }
    }
}
