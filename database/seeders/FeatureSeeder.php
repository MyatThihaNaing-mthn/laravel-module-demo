<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            ['name' => 'Blog'],
            ['name' => 'User Management'],
        ];

        foreach ($features as $feature) {
            Feature::updateOrCreate(
                ['name' => $feature['name']]
            );
        }
    }
}
