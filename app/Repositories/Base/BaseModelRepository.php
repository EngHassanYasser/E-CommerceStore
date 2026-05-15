<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModelRepository implements BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model =  $this->model();
    }
    abstract protected function model();
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($model, array $data)
    {
        $model->update($data);
        return $model->fresh();
    }
    public function updateByID($id, array $data)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model->fresh();
    }

    public function deleteByID($id)
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }
    public function delete($model)
    {
        return $model->delete();
    }
    public function restore($id)
    {
        $model = $this->model->onlyTrashed()->findOrFail($id);
        $model->restore();
    }
    public function forceDelete($id)
    {
        $model = $this->model->withTrashed()->findOrFail($id);

        return $model->forceDelete();
    }
    public function findTrash($id)
    {
        $model = $this->model->withTrashed()->findOrFail($id);

        return $model()->onlyTrashed()->findOrFail($id);
    }
    public function findModelWithRelations(Model $model, array $relations)
    {
        return $model->load($relations);
    }
    public function findWithRelationsById($id, array $relations)
    {
        $model = $this->model->withTrashed()->findOrFail($id);

        return $this->findModelWithRelations($model, $relations);
    }
    public function getPaginatedWithRelations(array $relations)
    {
        return $this->model->with($relations)->paginate(10);
    }
     public function destroy(Model $model)
    {
        return $model->delete();
    }
}
