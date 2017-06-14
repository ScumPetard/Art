<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Problem
 * @package App\Models
 */
class Problem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'ip',
    ];
}
