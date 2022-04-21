<?php

namespace App\Repository\Eloquent;

use App\Repository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**zz
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @param array|string[] $columns
     * @return mixed
     */
    function findById($id, array $columns = ['*'])
    {
        return $this->model->select($columns)->findOrFail($id);
    }

    /**
     * @param $email
     * @param array|string[] $columns
     * @return mixed
     */
    function findByEmail($email, array $columns = ['*'])
    {
        return $this->model->select($columns)->where('email', $email)->first();
    }

    function getAllData()
    {
        return $this->model->all();
    }

    function getAllDataByAnotherColumn($column, $value, $operator = '=')
    {
        return $this->model->where($column, $operator, $value)->get();
    }
    function findByAnotherColumn($column, $value, $operator = '=')
    {
        return $this->model->where($column, $operator, $value)->first();
    }
}
