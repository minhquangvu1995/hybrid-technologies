<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    public $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function insert(array $attributes)
    {
        return $this->model->insert($attributes);
    }

    public function update(Model $model, array $attributes, array $options = [])
    {
        $model->update($attributes, $options);
        return $model;
    }

    public function destroy(Model $model)
    {
        return $model->delete();
    }

    public function first()
    {
        return $this->model->first();
    }

    public function firstOrCreate(array $attributes)
    {
        return $this->model->firstOrCreate($attributes);
    }

    public function findOrFail($id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function deleteByIdList(array $idList)
    {
        return $this->model->whereIn('id', $idList)->delete();
    }


    public function updateDataByIdList(array $idList, array $data)
    {
        return $this->model->whereIn('id', $idList)->update($data);
    }

    public function findFirstByAttribute($attribute, $operator = '=', $value = null, array $columns = ['*'])
    {
        return $this->model->select($columns)
            ->where($attribute, $operator, $value)
            ->first();
    }

    public function findInArray($attribute, array $array = [], array $columns = ['*'])
    {
        return $this->model->select($columns)
            ->whereIn($attribute, $array)
            ->get();
    }

    public function updateOrCreate(array $attributes = [], array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

}
