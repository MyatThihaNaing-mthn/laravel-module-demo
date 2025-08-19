<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userManagementFeatureId = Feature::where('name', 'User Management')->first()->id;
        $blogFeatureId = Feature::where('name', 'Blog')->first()->id;

        $permissions = [
            ['name' => Permission::VIEWANY, 'feature_id' => $userManagementFeatureId],
            ['name' => Permission::VIEW, 'feature_id' => $userManagementFeatureId],
            ['name' => Permission::CREATE, 'feature_id' => $userManagementFeatureId],
            ['name' => Permission::UPDATE, 'feature_id' => $userManagementFeatureId],
            ['name' => Permission::DELETE, 'feature_id' => $userManagementFeatureId],
            ['name' => Permission::VIEW, 'feature_id' => $blogFeatureId],
            ['name' => Permission::VIEWANY, 'feature_id' => $blogFeatureId],
            ['name' => Permission::CREATE, 'feature_id' => $blogFeatureId],
            ['name' => Permission::UPDATE, 'feature_id' => $blogFeatureId],
            ['name' => Permission::DELETE, 'feature_id' => $blogFeatureId],
        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name'], 'feature_id' => $permission['feature_id']]
            );
        }
    }
}
