<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseRepository
{
    public function all();
    public function find($id);
    public function store(array $data);
    public function update($model, array $data);
    public function updateByID($id, array $data);
    public function deleteByID($id);
    public function delete($model);
    public function restore($id);
    public function forceDelete($id);
    public function findTrash($id);
    public function findModelWithRelations(Model $model, array $relations);
    public function findWithRelationsById($id, array $relations);
    public function getPaginatedWithRelations(array $relations);
    public function destroy(Model $model);
}
