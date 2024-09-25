<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name' => 'NeuroSync',
            'description' => 'NeuroSync',
            'email' => 'reggiestain15@gmail.com'
        ]);

    }
}
