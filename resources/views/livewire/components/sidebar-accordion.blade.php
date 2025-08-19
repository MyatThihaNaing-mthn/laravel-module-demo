<div class="space-y-1">
    <button
        wire:click="toggle"
        class="flex w-full cursor-pointer items-center rounded-md px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-700 @if($isOpen) bg-zinc-100 dark:bg-zinc-700 @endif"
    >
        <span class="mr-2">👥</span>&nbsp Users
        <span class="ml-auto">
            <svg class="h-5 w-5 @if($isOpen) rotate-180 @endif" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </span>
    </button>
    @if($isOpen)
        <div class="pl-4 space-y-1">
            @foreach ($actions as $action)
                <a href="{{ $action['href'] }}" class="block rounded-md px-3 py-2 text-sm text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-700" wire:navigate>
                    {{ $action['name'] }}
                </a>
            @endforeach
        </div>
    @endif
</div>