<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('users', Index::class)
    ->middleware(['auth', 'can:viewAny,App\Models\User'])
    ->name('users.index');

Route::get('users/create', 'App\Livewire\Users\Create')
    ->middleware(['auth', 'can:create,App\Models\User'])
    ->name('users.create');

Route::get('users/{user}/edit', 'App\Livewire\Users\Update')
    ->middleware(['auth', 'can:update,user'])
    ->name('users.edit');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});


Route::get('cache-test', function () {
    $user = auth()->user();
    if (!$user) {
        return 'User not authenticated';
    }
    return Cache::get("user_permissions_{$user->id}", 'No permissions found');
})->middleware('auth');

require __DIR__.'/auth.php';
