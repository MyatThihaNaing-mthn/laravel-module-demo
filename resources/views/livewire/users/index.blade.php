<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">
    <h1 class="text-2xl font-bold">{{ __('Users') }}</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse rounded-lg border border-neutral-200 dark:border-neutral-700">
            <thead class="bg-zinc-50 dark:bg-zinc-900">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Role</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-zinc-700 dark:text-zinc-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t border-neutral-200 dark:border-neutral-700">
                        <td class="px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300">{{ $user->username ?? $user->name }}</td>
                        <td class="px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300">{{ $user->getRoleName() }}</td>
                        <td class="px-4 py-2 text-sm">
                            @if(auth()->user()->can('update', $user))
                                <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center rounded-md cursor-pointer bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800" wire:navigate>Edit</a>
                            @endif
                            @if(auth()->user()->can('delete', $user))
                                <button wire:click="confirmDelete({{ $user->id }})" class="inline-flex items-center rounded-md cursor-pointer bg-red-100 px-3 py-1 text-sm font-medium text-red-600 hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 ml-2">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($selectedUserId)
        <div class="fixed inset-0 bg-gray-100 bg-opacity-90 flex items-center justify-center">
            <div class="bg-white p-6 rounded-md shadow-lg max-w-md w-full" style="color: #1f2937;">
                <h3 class="text-lg text-zinc-900! font-semibold mb-4">Confirm Deletion</h3>
                <p class="mb-4">
                    Are you sure you want to delete
                    <strong>{{ $selectedUserName }}</strong>?
                </p>

                @error('general')
                    <div class="text-red-500 mb-2">{{ $message }}</div>
                @enderror

                <div class="flex justify-end space-x-4">
                    <button wire:click="cancelDelete" class="bg-gray-300 cursor-pointer text-gray-700 px-4 py-2 rounded">Cancel</button>
                    <button wire:click="delete" class="bg-red-500 cursor-pointer text-white px-4 py-2 rounded">Delete</button>
                </div>
            </div>
        </div>
    @endif

</div>