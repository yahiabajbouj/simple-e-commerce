<?php


namespace App\Repositories\Eloquent;

use App\Helpers\Mapper;
use App\Helpers\Constants;
use App\Helpers\JsonResponse;
use App\Helpers\ResponseStatus;
use Illuminate\Container\Container as App;
use App\Repositories\IRepositories\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepository
{
    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function all($conditions = [], $columns = array('*'))
    {
        $per_page = request()->per_page ?? 5;
        $paginate = request()->paginate ?? true;
        $query = $this->model;
        if($paginate)
            return $query->paginate($per_page, $columns);
        else
            return $query->get($columns);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    abstract function model();

    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());
        return $this->model = $model;
    }
}