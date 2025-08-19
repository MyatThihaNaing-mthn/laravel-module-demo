<?php

namespace App\Policies;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Helpers\PermissionChecker;
use App\Models\Permission;


class FeaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user,Feature $feature): bool
    {
        \Log::info('FeaturePolicy::viewAny called for user: ' . $user->id);
        return PermissionChecker::hasPermission(Permission::VIEWANY, $feature->getFeatureNameAttribute());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, string $featureName): bool
    {
        \Log::info('FeaturePolicy::view called for user: ' . $user->id);
        return PermissionChecker::hasPermission(Permission::VIEW, $featureName);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Feature $feature): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Feature $feature): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Feature $feature): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Feature $feature): bool
    {
        return false;
    }
}
