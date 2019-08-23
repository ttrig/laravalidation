<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull as Middleware;

class ConvertEmptyStringsToNull extends Middleware
{
    protected function transform($key, $value)
    {
        return (request()->has('disable-middleware'))
            ? $value
            : parent::transform($key, $value);
    }
}
