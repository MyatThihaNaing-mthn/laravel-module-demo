<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Now;
use App\Models\User;


class LoginListener
{
    
    public function handle(Login $event)
    {
        $user = $event->user;

        if (!$user || !$user->role_id) {
            Log::warning('LoginListener: User or role_id is missing', [
                'user_id' => $user?->id,
                'role_id' => $user?->role_id,
            ]);
            return;
        }

        try {
            $permissions = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->join('role_permissions', 'roles.id', '=', 'role_permissions.role_id')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->join('features', 'features.id', '=', 'permissions.feature_id')
                ->where('roles.id', $user->role_id)
                ->select(DB::raw("CONCAT(permissions.name, '.', features.name) as name"))
                ->pluck('name')
                ->toArray();

            Log::info('LoginListener: Permissions fetched for user', [
                'user_id' => $user->id,
                'permissions' => $permissions,
            ]);

            $cacheKey = "user_permissions_{$user->id}";
            Cache::put($cacheKey, $permissions, now()->addDays(7));

            // Verify cache was set
            if (Cache::has($cacheKey)) {
                Log::info('LoginListener: Permissions cached successfully', [
                    'user_id' => $user->id,
                    'cache_key' => $cacheKey,
                ]);
            } else {
                Log::error('LoginListener: Failed to cache permissions', [
                    'user_id' => $user->id,
                    'cache_key' => $cacheKey,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('LoginListener: Error fetching or caching permissions', [
                'user_id' => $user?->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}