<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oauth extends Model
{
    protected $fillable = [
        'client_id',
        'module_id',
    ];
}
