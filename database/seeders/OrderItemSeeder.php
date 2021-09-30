<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id'=>1, 'order_id'=>1, 'product_id'=> 4, 'unit_price'=> 500, 'quantity'=> 2],
            ['id'=>2, 'order_id'=> 2, 'product_id'=> 3, 'unit_price'=> 300, 'quantity'=> 1],
            ['id'=>3, 'order_id'=> 2, 'product_id'=> 2, 'unit_price'=> 300, 'quantity'=> 1],
        ];
        OrderItem::insert($data); 
    }
}
