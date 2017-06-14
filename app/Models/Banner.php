<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 轮播图
 *
 * Class WorkDate
 * @package App\Models
 */
class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'name','url', 'link', 'sort','is_hidden','is_cat','intro'
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

    public function isHidden()
    {
        return !! $this->is_hidden == 0;
    }
}
