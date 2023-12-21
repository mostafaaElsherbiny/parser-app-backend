<?php

namespace App\Traits;

trait FilterAble
{
    public function scopeFilter($query, $filter_by, $filter_value)
    {
        return $query->where($filter_by, "=", $filter_value);
    }
}
