<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Customer::create([
            'user_id'   => '31072024001',
            'name'  => 'Ahmad Susanto',
            'email' => 'hirojerseyshop@gmail.com',
            'status'    => 0,
        ]);
    }
}
