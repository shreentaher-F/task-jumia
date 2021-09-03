<?php

namespace App\Http\Filters;

class CustomerFilter extends QueryFilter
{

    public function countryCode($country_code)
    {
        $this->builder->where('phone', 'like', ["_$country_code%"]);
    }

    public function state($state)
    {    //** not supported REGEXP, REGEXP_LIKE *//
        // $this->builder->whereRaw("phone REGEXP_LIKE " ."[5-9]\d{8}$");
    }
}
