<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UsersTable extends Component
{
    public $data;
    public function mount()
    {
        $this->data = null;
    }
    public function render()
    {
        $this->data = DB::table('users')->get();
        return view('livewire.users-table');
    }
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('close', ['message' => '']);
    }
}
