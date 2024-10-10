<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NeuroClass;

class NeuroClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of neuro classes
        $classes = [
            ['name' => 'Nursery 1', 'description' => 'Neurodevelopmental class for Nursery 1 students.'],
            ['name' => 'Nursery 2', 'description' => 'Neurodevelopmental class for Nursery 2 students.'],
            ['name' => 'KG1', 'description' => 'Kindergarten class KG1 focused on neurodevelopmental activities.'],
            ['name' => 'KG2', 'description' => 'Kindergarten class KG2 focused on cognitive and developmental skills.'],
            ['name' => 'Year 1', 'description' => 'Neurodevelopmental class for Year 1 students.'],
            ['name' => 'Year 2', 'description' => 'Neurodevelopmental class for Year 2 students.'],
            ['name' => 'Year 3', 'description' => 'Neurodevelopmental class for Year 3 students.'],
            ['name' => 'Year 4', 'description' => 'Neurodevelopmental class for Year 4 students.'],
            ['name' => 'Homeschooling Unit', 'description' => 'Special neurodevelopmental homeschooling unit.'],
        ];

        // Insert each class into the neuro_classes table
        foreach ($classes as $class) {
            NeuroClass::create($class);
        }
    }
}
