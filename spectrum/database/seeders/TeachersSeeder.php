<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            ['first_name' => 'Stephanie', 'last_name' => 'Mensah', 'email' => 'stephanie.mensah@gmail.com'],
            ['first_name' => 'Patience', 'last_name' => 'Koranteng', 'email' => 'patience.koranteng@gmail.com'],
            ['first_name' => 'Amy', 'last_name' => 'Awortwe', 'email' => 'amy.awortwe@gmail.com'],
            ['first_name' => 'Lydia', 'last_name' => '', 'email' => 'lydia@gmail.com'],
            ['first_name' => 'Doris', 'last_name' => 'Doe Amedze', 'email' => 'doris.doe.amedze@gmail.com'],
        ];

        foreach ($teachers as $teacher) {
            DB::table('teachers')->insert([
                'first_name' => $teacher['first_name'],
                'last_name' => $teacher['last_name'],
                'email' => $teacher['email'],
                'phone' => "",
                'address'=>"",
                'school_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
