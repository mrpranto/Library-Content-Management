<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait SetAttrs
{
    protected array $attributes = [];

    public function setAttrs(array $attrs): self
    {
        $this->attributes = $attrs;

        return $this;
    }

    public function setAttribute($key, $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function setAttr($key, $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function mergeAttributes(array $attrs): self
    {
        $this->attributes = array_merge($this->attributes, $attrs);

        return $this;
    }

    public function mergeAttrs(array $attrs): self
    {
        $this->attributes = array_merge($this->attributes, $attrs);

        return $this;
    }

    public function getAttributes($columns = null): array
    {
        $columns = is_array($columns) ? $columns : func_get_args();

        if (count($columns)) {
            return Arr::only($this->attributes, $columns);
        }

        return $this->attributes;
    }

    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttrs($columns = null): array
    {
        $columns = is_array($columns) ? $columns : func_get_args();

        if (count($columns)) {
            return Arr::only($this->attributes, $columns);
        }

        return $this->attributes;
    }

    public function getAttribute($key, $default = null)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : $default;
    }

    public function getAttr($key, $default = null)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : $default;
    }

    public function getFillAble($parameters = []): array
    {
        return count($this->attributes) ? $this->attributes : $parameters;
    }
}
