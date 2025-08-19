<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    public $users = [];
    public $selectedUserId = null;
    public $selectedUserName = '';

    public function mount()
    {
        Gate::authorize('viewAny', User::class);
        $this->users = User::with('role')->get();
    }

    public function confirmDelete($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::findOrFail($userId);
        $this->selectedUserName = $user->username ?? $user->name;
    }

    public function cancelDelete()
    {
        $this->selectedUserId = null;
    }

    public function delete()
    {
        $user = User::findOrFail($this->selectedUserId);
        $this->authorize('delete', $user);

        try {
            $user->delete();

            // Refresh users
            $this->users = User::with('role')->get();

            // Close modal
            $this->selectedUserId = null;

            session()->flash('message', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user', [
                'user_id' => $this->selectedUserId,
                'error' => $e->getMessage(),
            ]);
            $this->addError('general', 'Failed to delete user. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.users.index');
    }
}
