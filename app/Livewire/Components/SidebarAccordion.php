<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class SidebarAccordion extends Component
{
    public $isOpen = false;
    public $actions = [];

    public function mount(){
        if($user = auth()->user()){
            if(Gate::allows('create', User::class)){
                $this->actions[] = [
                    'name' => 'Create User',
                    'href' => '/users/create',
                    'icon' => 'i-heroicons-user-plus-solid',
                ];
            }
            if(Gate::allows('viewAny', User::class)){
                $this->actions[] = [
                    'name' => 'View Users',
                    'href' => '/users',
                    'icon' => 'i-heroicons-users-solid',
                ];
            }
        }
    }
    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        \Log::info('Toggle called, isOpen: ' . ($this->isOpen ? 'true' : 'false'));
    }
    public function render()
    {
        return view('livewire.components.sidebar-accordion');
    }
}
