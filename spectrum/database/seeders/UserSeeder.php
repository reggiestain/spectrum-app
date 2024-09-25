<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Reginald',
            'surname' => 'Bossman',
            'email' => 'reggiestain@gmail.com',
            'phone' => '',
            'school_id' => 1,
            'role_id' => 1, 
            'birth_date' => '',
            'status' => 'Active',
            'lastlogin' => '',
            'password' => bcrypt('Admin123!')
        ]);
    }
}
