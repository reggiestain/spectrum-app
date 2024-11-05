<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParentModel;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParentModel::insert([
            ['first_name' => 'Mrs', 'last_name' => 'Mccarthy', 'email' => 'nemcarthy@yahoo.com', 'phone' => '123-456-7890', 'address' => '123 Main St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Khadijah', 'email' => 'johndoe1@gmail.com', 'phone' => '', 'address' => ''],
            ['first_name' => 'Mr and Mrs', 'last_name' => 'Budu', 'email' => 'peearmstrong@gmail.com', 'phone' => '123-456-7891', 'address' => '456 Elm St, City'],
            ['first_name' => 'Karen', 'last_name' => 'Akrong', 'email' => 'johndoe2@gmail.com', 'phone' => '123-456-7892', 'address' => '789 Pine St, City'],
            ['first_name' => 'Karen', 'last_name' => 'Akler', 'email' => 'karenakler@yahoo.com', 'phone' => '123-456-7893', 'address' => '101 Maple St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Nikki', 'email' => 'nikki@gmail.com', 'phone' => '123-456-7894', 'address' => '202 Oak St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Fafa', 'email' => 'fafaackuakaopoku@gmail.com', 'phone' => '123-456-7895', 'address' => '303 Cedar St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Eunice', 'email' => 'adikie23@gmail.com', 'phone' => '123-456-7896', 'address' => '404 Birch St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Edem', 'email' => 'edembaah10@yahoo.com', 'phone' => '123-456-7897', 'address' => '505 Walnut St, City'],
            ['first_name' => 'Aunty', 'last_name' => 'Naa', 'email' => 'mstagoe@ymail.com', 'phone' => '123-456-7898', 'address' => '606 Chestnut St, City'],
            ['first_name' => 'Mr and Mrs', 'last_name' => 'Omane', 'email' => 'kaomane@ymail.com', 'phone' => '123-456-7899', 'address' => '707 Willow St, City'],
            ['first_name' => 'Mr and Mrs', 'last_name' => 'Omane', 'email' => 'kaomane@gmail.com', 'phone' => '123-456-7900', 'address' => '808 Spruce St, City'],
            ['first_name' => 'Mr and Mrs', 'last_name' => 'Kwarifa', 'email' => 'nataliekwarifa@me.com', 'phone' => '123-456-7901', 'address' => '909 Fir St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Ayo', 'email' => 'ayomide.laryea@gmail.com', 'phone' => '123-456-7902', 'address' => '1010 Redwood St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Rachel', 'email' => 'johndoe3@gmail.com', 'phone' => '', 'address' => ''],
            ['first_name' => 'Helena', 'last_name' => 'Osei', 'email' => 'johndoe4@gmail.com', 'phone' => '123-456-7903', 'address' => '1111 Ash St, City'],
            ['first_name' => 'Edna', 'last_name' => 'Adonkoh', 'email' => 'johndoe5@gmail.com', 'phone' => '123-456-7904', 'address' => '1212 Poplar St, City'],
            ['first_name' => 'Mr and Mrs', 'last_name' => 'Blyne', 'email' => 'johndoe6@gmail.com', 'phone' => '123-456-7905', 'address' => '1313 Dogwood St, City'],
            ['first_name' => 'Mrs', 'last_name' => 'Sokpe', 'email' => 'johndoe7@gmail.com', 'phone' => '123-456-7906', 'address' => '1414 Sycamore St, City'],
            ['first_name' => 'Mrs', 'last_name' => 'Osei', 'email' => 'johndoe8@gmail.com', 'phone' => '123-456-7907', 'address' => '1515 Magnolia St, City'],
            ['first_name' => 'Madam', 'last_name' => 'Abena', 'email' => 'johndoe9@gmail.com', 'phone' => '123-456-7908', 'address' => '1616 Cherry St, City'],
        ]);
    }
}
