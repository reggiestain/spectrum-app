<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'System Admin',
            'description' => 'System Admin',
        ]);

        Role::create([
            'name' => 'Therapist',
            'description' => 'Therapist',
        ]);

        Role::create([
            'name' => 'Parent',
            'description' => 'Parent',
        ]);
    }
}
