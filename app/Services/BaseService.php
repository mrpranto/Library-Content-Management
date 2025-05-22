<?php

namespace App\Services;

use App\Traits\SetAttrs;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    use SetAttrs;

    protected Model $model;

    const DEFAULT_LIMIT = 20;
    const DEFAULT_ORDER_BY = 'id';
    const DEFAULT_ORDER_DIRECTION = 'desc';

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model): BaseService
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param $options
     * @return Model
     */
    public function save($options = []): Model
    {
        cache()->flush();

        $attributes = count($options) ? $options : request()->all();

        $this->model
            ->fill($this->getFillAble($attributes))
            ->save();

        return $this->model;
    }

    /**
     * @param $id
     * @return Model|array|null
     */
    public function find($id): Model|array|null
    {
        return $this->model =  $this->model::query()->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return mixed
     */
    public function exists(string $column, string $value): mixed
    {
        return $this->model->where($column, $value)->exists();
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->model->{$method}(...$arguments);
    }
}
