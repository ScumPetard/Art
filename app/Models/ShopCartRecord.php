<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCartRecord extends Model
{
    protected $table = 'shop_cart_records';

    protected $fillable = [
        'client_id',
        'file_path'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
