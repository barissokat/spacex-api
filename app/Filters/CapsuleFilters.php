<?php

namespace App\Filters;

use App\Capsule;

class CapsuleFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['status'];

    /**
     * Filter the query by a given status code.
     *
     * @param  string $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($code)
    {
        return $this->builder->where('status', $code);
    }
}
