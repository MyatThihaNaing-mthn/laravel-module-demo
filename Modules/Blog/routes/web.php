<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

// Remove feature magic string
Route::get('blog-management', \Modules\Blog\Livewire\Index::class)
    ->middleware(['auth', 'feature', 'can:viewAny,App\Models\Feature,feature'])
    ->name('blog.index');