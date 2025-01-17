<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name'  => 'Marcello Yoel',
            'username'  => 'marcello123',
            'email' => 'marcelloyoel10@gmail.com',
            'password' => bcrypt('12345')
        ]);
    }
}
