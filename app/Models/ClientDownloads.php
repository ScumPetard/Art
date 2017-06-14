<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 机构客户下载记录
 * Class Client
 * @package App\Models
 */
class ClientDownloads extends Model
{
    protected $table = 'client_downloads';

    protected $fillable = [
        'work_id',
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
}
