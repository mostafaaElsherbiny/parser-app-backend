<?php

namespace App\Traits;

trait SearchAble
{
    public function scopeSearch($query, $filterBy, $filterValue)
    {
        return $query->where($filterBy, "like", '%' . $filterValue . '%')
            ->orWhere($filterBy, "like", $filterValue . '%')
            ->orWhere($filterBy, "like", '%' . $filterValue);
    }
}
