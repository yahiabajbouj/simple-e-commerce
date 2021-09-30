<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id'=>1, 'first_name'=>'Mohamad', 'last_name'=> 'Zid', 'city'=> 'Beirut', 'country'=> 'Lebanon', 'phone'=>'02015485546'],
            ['id'=>2, 'first_name'=>'Samer', 'last_name'=> 'Salam', 'city'=> 'Damascus', 'country'=> 'Syria', 'phone'=>'555456687'],
        ];
        Customer::insert($data); 
    }
}
