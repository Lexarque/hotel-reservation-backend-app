<?php

namespace App\Shareds;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    /**
     * Add the desired relation to each module services
     *
     * @var array
     */
    protected $with = [];

    public function __construct(public Model $model)
    {
    }

    /**
     * This function is used to find the model data by id
     *
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->model->with($this->with)->findOrFail($id);
    }

    /**
     * This function is used to find all data of the model
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->with($this->with)->get();
    }

    /**
     * Create function
     *
     * @param Model $model
     * @return void
     * @throws \Throwable
     */
    public function create(Model $model): void
    {
        $model->saveOrFail();
    }

    /**
     * Update function
     *
     * @param Model $model
     * @return void
     * @throws \Throwable
     */
    public function update(Model $model): void
    {
        $model->updateOrFail();
    }

    /**
     * Delete function
     *
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function delete(int $id): void
    {
        $model = $this->model->findOrFail($id);
        $model->deleteOrFail();
    }

    /**
     * Force delete a soft deleted data
     *
     * @param integer $id
     * @return void
     */
    public function forceDelete(int $id): void
    {
        $model = $this->model->withTrashed()->findOrFail($id);
        $model->forceDelete();
    }

    /**
     * This function is used to restore soft deleted data
     *
     * @param integer $id
     * @return void
     */
    public function restore(int $id): void
    {
        $model = $this->model->withTrashed()->findOrFail($id);
        $model->restore();
    }
}
