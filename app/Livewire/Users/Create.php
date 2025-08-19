<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\Role;
use App\Models\User;


class Create extends Component
{
    public $roles = [];
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id;

    public function mount()
    {
        $this->roles = Role::all();
    }

    protected function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function save(){
        $this->validate();

        User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role_id' => $this->role_id,
        ]);

        $this->reset(['username', 'email', 'password', 'role_id']);
        $this->redirect(route('users.index'));
    }


    public function render()
    {
        return view('livewire.users.create');
    }
}
