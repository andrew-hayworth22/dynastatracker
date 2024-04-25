<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class IsActiveFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        switch ($value) {
            case 'Active':
                $query->where('is_active', true);
                break;
            case 'Inactive':
                $query->where('is_active', false);
                break;
            case 'All':
                break;
        }
    }
}
