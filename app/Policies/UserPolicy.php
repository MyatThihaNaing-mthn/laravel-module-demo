<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Helpers\PermissionChecker;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    const FEATURE_NAME = 'User Management';
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        \Log::info('UserPolicy::viewAny called for user: ' . $user->id);
        return PermissionChecker::hasPermission(Permission::VIEWANY, self::FEATURE_NAME);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return PermissionChecker::hasPermission(Permission::VIEW, self::FEATURE_NAME ) || $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return PermissionChecker::hasPermission(Permission::CREATE, self::FEATURE_NAME);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        $adminRoleId = Role::where('name', Role::ADMIN)->value('id');

        if(PermissionChecker::hasPermission(Permission::UPDATE, self::FEATURE_NAME)) {
            if($user->role?->id === $adminRoleId) {
                return true; // Admins can update anyone
            } else if($model->role?->id === $adminRoleId) {
                return false; // Non-admins cannot update admins
            }
            return true; // Everyone else can update
        }

        return false; // Everyone else can update
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
         // Prevent self deletion
        if ($user->id === $model->id) return false;
        
        // Admins cannot delete each other
        if ($user->role?->name === Role::ADMIN && $model->role?->name === Role::ADMIN) {
            return false;
        }
        return PermissionChecker::hasPermission(Permission::DELETE, self::FEATURE_NAME);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return PermissionChecker::hasPermission(Permission::RESTORE, self::FEATURE_NAME);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return PermissionChecker::hasPermission(Permission::FORCE_DELETE, self::FEATURE_NAME);
    }
}
