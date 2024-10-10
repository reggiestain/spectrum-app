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
            ['first_name' => 'Angela', 'last_name' => 'Asumah','email'=>'Angela@gmail.com'],
            ['first_name' => 'Shilla', 'last_name' => 'Klu','email'=>'test2@gmail.com'],
            ['first_name' => 'Amy', 'last_name' => 'Awortwe','email'=>'test3@gmail.com'],
            ['first_name' => 'Gideon', 'last_name' => 'Nii Sai Obodai','email'=>'test4@gmail.com'],
            ['first_name' => 'Jennifer', 'last_name' => 'Yenimi Grant','email'=>'test5@gmail.com'],
            ['first_name' => 'Richmond', 'last_name' => 'Doe Amedze','email'=>'test6@gmail.com'],
            ['first_name' => 'Paula', 'last_name' => 'Owusu','email'=>'test7@gmail.com'],
            ['first_name' => 'Monica', 'last_name' => 'Attiogbe','email'=>'test8@gmail.com'],
            ['first_name' => 'Rita', 'last_name' => 'Ejodnawo','email'=>'test9@gmail.com'],
            ['first_name' => 'Mariam', 'last_name' => 'Nasiru','email'=>'test10@gmail.com'],
            ['first_name' => 'Doris', 'last_name' => 'Kobeh','email'=>'test12@gmail.com'],
            ['first_name' => 'Joyce', 'last_name' => 'Simpiri','email'=>'test28@gmail.com'],
            ['first_name' => 'Linda', 'last_name' => 'Nugah','email'=>'test23@gmail.com'],
            ['first_name' => 'Patience', 'last_name' => 'Koranteng','email'=>'test34@gmail.com'],
            ['first_name' => 'Stephanie', 'last_name' => '','email'=>'test35@gmail.com'], // No last name provided for Stephanie
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
