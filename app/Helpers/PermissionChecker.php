<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PermissionChecker
{
    
    public static function hasPermission(string $permission, string $feature): bool
    {

        
        $user = auth()->user();
        if (!$user) {
            return false;
        }
        Log::info("Checking permission: {$permission} for feature: {$feature} for user: {$user->id}");
        $featurePermissions = Cache::get("user_permissions_{$user->id}", []);

        $requiredPermission = "{$permission}.{$feature}";
        return in_array($requiredPermission, $featurePermissions);
        
    }
}