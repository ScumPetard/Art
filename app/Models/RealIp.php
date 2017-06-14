<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 机构客户IP范围
 * Class Client
 * @package App\Models
 */
class RealIp extends Model
{
    protected $table = 'real_ips';

    protected $fillable = [
        'ip',
        'client_id',
    ];

    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }

    public function getUpdatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
