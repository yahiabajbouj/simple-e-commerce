<?php


namespace App\Repositories\IRepositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IBaseRepository
{
    public function makeModel();
  
    public function all($conditions = [], $columns = array('*'));

    public function create( $model);
    
    public function update(array $data, $id, $attribute = "id");

    public function delete($id) ;

    public function find($id, $columns = array('*'));

    function model();
}