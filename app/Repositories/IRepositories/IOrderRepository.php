<?php
namespace App\Repositories\IRepositories;

interface IOrderRepository extends IBaseRepository
{
    public function syncItems($model, $items);
}