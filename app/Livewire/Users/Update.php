<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class Update extends Component
{
    public $user;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id;
    public $roles = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role_id = $user->role_id;

        $this->roles = Role::all();

        // Filter out Admin role if the user is not an Admin
        if($user->getRoleName() !== Role::ADMIN) {
            $this->roles = $this->roles->filter(function($role) {
                return $role->name !== Role::ADMIN;
            });
        }
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:4|confirmed',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function edit(){
        $this->validate();

        // Check if the user is trying to change to Admin role
        if($this->role_id == Role::where('name', Role::ADMIN)->value('id') && $this->user->getRoleName() !== Role::ADMIN) {
            session()->flash('error', 'You cannot change a user to Admin role.');
            return;
        }

        $this->user->update([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $this->user->password,
            'role_id' => $this->role_id,
        ]);

        session()->flash('message', 'User updated successfully.');
        $this->redirect(route('users.index'));
    }
    public function render()
    {
        return view('livewire.users.update');
    }
}
