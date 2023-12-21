<?php
namespace App\Traits;

trait SortAble
{
    public function scopeSort($query, $sortBy, $sortValue)
    {
        return $query->orderBy($sortBy, $sortValue);
    }
}
