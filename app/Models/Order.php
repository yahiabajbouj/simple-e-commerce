<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['order_date', 'order_number', 'customer_id', 'total_amount'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('unit_price', 'quantity');;
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['customer'] = $this->customer;
        return $data;
    }
}
