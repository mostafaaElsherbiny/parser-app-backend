<?php
namespace App\Traits;

trait SearchAble
{
    public function scopeSearch($query, $filter_by, $filter_value)
    {
        return $query->where($filter_by, "like", '%' . $filter_value . '%')
            ->orWhere($filter_by, "like", $filter_value . '%')
            ->orWhere($filter_by, "like", '%' . $filter_value);
    }
}
