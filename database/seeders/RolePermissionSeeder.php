<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Feature;
use App\Models\RolePermission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get role IDs
        $adminRole = Role::where('name', Role::ADMIN)->first();
        $editorRole = Role::where('name', Role::EDITOR)->first();

        // Get User Management feature ID
        $userManagementFeatureId = Feature::where('name', 'User Management')->first()->id;

        // Get all permissions
        $allPermissions = Permission::all();
        
        // Get specific permissions for Editor (viewAny, view, edit for User Management only)
        $editorPermissions = Permission::whereIn('name', [Permission::VIEWANY, Permission::VIEW, Permission::UPDATE])
            ->where('feature_id', $userManagementFeatureId)
            ->get();

        // Assign all permissions to Admin
        foreach ($allPermissions as $permission) {
            RolePermission::updateOrCreate([
                'role_id' => $adminRole->id,
                'permission_id' => $permission->id
            ]);
        }

        // Assign viewAny, view, and edit permissions to Editor for User Management
        foreach ($editorPermissions as $permission) {
            RolePermission::updateOrCreate([
                'role_id' => $editorRole->id,
                'permission_id' => $permission->id
            ]);
        }
    }
}
