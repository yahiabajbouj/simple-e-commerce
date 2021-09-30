<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'unit_price', 'supplier_id'];
    
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
    }
}
