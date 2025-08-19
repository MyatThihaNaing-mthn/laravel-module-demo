<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">
    <form wire:submit.prevent="edit" class="space-y-6 mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ __('Edit User') }}</h1>

        @if (session()->has('message'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Username -->
        <div class="space-y-2">
            <label for="username" class="block text-sm font-medium text-zinc-700">Username</label>
            <input type="text" id="username" wire:model='username'
                class="mt-1 block w-full rounded-md border p-2"
                required>
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-zinc-700">Email</label>
            <input type="email" id="email" wire:model="email"
                class="mt-1 block w-full rounded-md border p-2"
                required>
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-zinc-700">Password (leave blank to keep)</label>
            <input type="password" id="password" wire:model="password"
                class="mt-1 block w-full rounded-md border p-2">
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Confirm Password</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                class="mt-1 block w-full rounded-md border p-2">
        </div>

        <!-- Role -->
        <div class="space-y-2">
            <label for="role" class="block text-sm font-medium text-zinc-700">Role</label>
            <select id="role" wire:model="role_id" class="mt-1 block w-full rounded-md border p-2">
                <option value="">Select a role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('users.index') }}"
            class="px-4 py-2 rounded-md bg-zinc-200 text-zinc-700 hover:bg-zinc-300">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                Update User
            </button>
        </div>
    </form>

</div>
