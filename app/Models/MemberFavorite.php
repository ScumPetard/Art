<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 机构客户收藏记录
 * Class Client
 * @package App\Models
 */
class MemberFavorite extends Model
{
    protected $table = 'member_work';

    protected $fillable = [
        'member_id',
        'work_id',
    ];

    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }   return Carbon::parse($date)->diffForHumans();
    }
    public function getUpdatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }   return Carbon::parse($date)->diffForHumans();
    }
}
