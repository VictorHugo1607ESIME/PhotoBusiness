<?php

namespace App\Http\Livewire;

use Livewire\Component;
use  App\Models\User;
use Illuminate\Support\Facades\DB;

class UserAdd extends Component
{
    public $email;
    public $user_name;
    public $name;
    public $last_name;
    public $password;
    public $role = 2;
    public $type = 'password';
    public function render()
    {
        return view('livewire.user-add');
    }

    public function save()
    {
        try {
            $modelUser = new User();
            $exists = DB::table('users')->where('email', trim($this->email))->first();
            $data = [
                'user_name' => $this->user_name,
                'first_name' => $this->name,
                'last_name' => $this->last_name,
                'password' => $this->password,
                'email' => $this->email,
                'id_role' => $this->role,
            ];
            $user_id = $modelUser->create($data);
            dd($user_id);
            $this->resetVal();
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
        $this->emit('render');
    }

    public function typeChange()
    {
        if ($this->type == 'password') {
            $this->type = "text";
        } else {
            $this->type = "password";
        }
    }
    function resetVal()
    {
        $this->user_name = null;
        $this->name = null;
        $this->last_name = null;
        $this->password = null;
        $this->email = null;
        $this->role = null;
    }
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('close', ['message' => '']);
    }
}
