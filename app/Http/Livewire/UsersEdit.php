<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersEdit extends Component
{
    public $email;
    public $user_name;
    public $name;
    public $last_name;
    public $password;
    public $type = 'password';
    public $idUser;
    public $user;
    public $users_online;
    public $users_max_online;
    public $download_numbers;
    public $max_download_numbers;
    public function mount($id)
    {
        $this->idUser = $id;
        $user = DB::table('users')->where('id', $this->idUser)->first();
        if ($user) {
            $this->email = $user->email;
            $this->name = $user->first_name;
            $this->user_name = $user->user_name;
            $this->last_name = $user->last_name;
            $this->users_online = $user->users_online;
            $this->users_max_online = $user->users_max_online;
            $this->download_numbers = $user->download_numbers;
            $this->max_download_numbers= $user->max_download_numbers;
        }
    }
    public function render()
    {
        // $this->user = DB::table('users')->where('id', $this->idUser)->first();
        return view('livewire.users-edit');
    }
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('close', ['message' => '']);
    }
    public function save() {
        $user=DB::table('users')->where('id', $this->idUser)->update([
            'user_name' => $this->user_name,
            'first_name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'users_max_online'=>(int)$this->users_max_online,
            'max_download_numbers'=>(int)$this->max_download_numbers
        ]);
        $this->password = null;
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
    public function changePass()
    {
        if ($this->password != null && trim($this->password) !== '') {
            $user = DB::table('users')->where('id', $this->idUser)->update([
                'password' =>  Hash::make(trim($this->password)),
            ]);
        }
        $this->password = null;
        $this->emit('render');
    }
}
