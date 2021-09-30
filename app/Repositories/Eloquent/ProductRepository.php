<?php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\IRepositories\IProductRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function model()
    {
        return Product::class;
    }
}
