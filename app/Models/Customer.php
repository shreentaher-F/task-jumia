<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone'
    ];

    protected $table = 'customer';

}
