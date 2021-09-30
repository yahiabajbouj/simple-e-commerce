<?php

namespace App\Repositories\Eloquent;

use App\Models\{Order, Product};
use App\Repositories\IRepositories\IOrderRepository;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    public function model()
    {
        return Order::class;
    }

    public function syncItems($model, $items)
    {
        $sync = [];
        foreach($items as $item){
            $sync[$item['product_id']] = ["quantity" => $item["quantity"], "unit_price" => Product::find($item['product_id'])->unit_price];
        }
        $model->products()->sync($sync);
    }
}
