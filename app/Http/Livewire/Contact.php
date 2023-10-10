<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class Contact extends Component
{
    public $email;
    public $name;
    public $message;
    public $phone;

    public $btn;

    public function mount()
    {
        $this->resetear();
    }

    public function render()
    {
        if (request()->cookie('contact')) {
            $this->btn = 'hidden';
        } else {
            $this->btn = null;
        }
        return view('livewire.contact');
    }

    public function save()
    {
        try {
            if ($this->email != null &&  $this->name != null && $this->phone != null) {
                $contacto = DB::table('contacts')->insert([
                    'contact_name' => trim($this->name),
                    'contact_email' => trim($this->email),
                    'contact_phone' => trim($this->phone),
                    'contact_message' => trim($this->message)
                ]);
                cookie()->queue(cookie('contact', true, 30));
                $this->dispatchBrowserEvent('success', ['message' => 'Datos enviados']);
            } else {
                $this->dispatchBrowserEvent('error', ['message' => 'No se envio intente mas tarde']);
            }
            $this->resetear();
        } catch (\Throwable $th) {
            //throw $th;
        }
        $this->emit('render');
    }
    public function resetear()
    {
        $this->email = null;
        $this->name = null;
        $this->message = null;
        $this->phone = null;
    }
}
