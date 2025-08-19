{{-- resources/views/users/create.blade.php --}}
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-6">
            <h1 class="text-2xl font-bold text-zinc-700 dark:text-zinc-300 mb-4">{{ __('Create New User') }}</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="save" class="space-y-6  max-w-[660px]">

                <!-- Username -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Username</label>
                    <input type="text" id="username" wire:model='username' value="{{ old('username') }}"
                           class="mt-1 block w-full rounded-md border border-neutral-300 bg-white shadow-sm
                                  focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100 p-2"
                           required>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Email</label>
                    <input type="email" id="email" wire:model="email" value="{{ old('email') }}"
                           class="mt-1 block w-full rounded-md border border-neutral-300 bg-white shadow-sm
                                  focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100 p-2"
                           required>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Password</label>
                    <input type="password" id="password" wire:model="password"
                           class="mt-1 block w-full rounded-md border border-neutral-300 bg-white shadow-sm
                                  focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100 p-2"
                           required>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Confirm Password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                           class="mt-1 block w-full rounded-md border border-neutral-300 bg-white shadow-sm
                                  focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100 p-2"
                           required>
                </div>

                <!-- Role -->
                <div class="space-y-2">
                    <label for="role" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Role</label>
                    <select id="role" wire:model="role_id"
                            class="mt-1 block w-full rounded-md border border-neutral-300 bg-white shadow-sm
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                   dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100 p-2">
                        <option value="">Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 rounded-md bg-zinc-200 text-zinc-700 hover:bg-zinc-300
                              dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600 cursor-pointer">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700
                                   focus:ring focus:ring-indigo-300 cursor-pointer">
                        Create User
                    </button>
                </div>
            </form>
        </div>
