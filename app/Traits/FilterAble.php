<?php

namespace App\Traits;

trait FilterAble
{
    public function scopeFilter($query, $filterBy, $filterValue)
    {
        return $query->where($filterBy, "=", $filterValue);
    }
}
