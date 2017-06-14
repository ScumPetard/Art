<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRecord extends Model
{
    protected $table = 'click_records';

    protected $fillable = [
        'module_id',
        'type',
        'name',
        'click_time',
        'client_id'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
