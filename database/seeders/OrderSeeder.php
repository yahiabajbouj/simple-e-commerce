<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'order_date'=> '2020-07-5', 'order_number'=> 5, 'customer_id'=> 1, 'total_amount'=> 1000],
            ['id' => 2, 'order_date'=> '2020-08-14', 'order_number'=> 8, 'customer_id'=> 2, 'total_amount'=> 600],
        ];
        Order::insert($data);     
    }
}
