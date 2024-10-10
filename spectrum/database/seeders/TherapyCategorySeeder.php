<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TherapyCategory;

class TherapyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TherapyCategory::create([
            'name' => 'Speech and Language Therapy',
            'description' => 'A therapy focused on improving communication skills and addressing speech disorders.'
        ]);

        TherapyCategory::create([
            'name' => 'Occupational Therapy',
            'description' => 'A therapy that helps individuals develop, recover, and improve the skills needed for daily living and working.'
        ]);

        TherapyCategory::create([
            'name' => 'Behavioral Therapy',
            'description' => 'A therapy that helps in modifying harmful behaviors and developing healthy behaviors through conditioning techniques.'
        ]);
    }
}
