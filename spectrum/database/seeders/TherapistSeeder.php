<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Therapist;

class TherapistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Therapist::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '123-456-7890',
            'specialization' => 'Speech Therapy',
            'bio' => 'John Doe has been practicing speech therapy for 10 years.'
        ]);

        Therapist::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '098-765-4321',
            'specialization' => 'Occupational Therapy',
            'bio' => 'Jane Smith is an expert in occupational therapy with over 15 years of experience.'
        ]);
    }
}
