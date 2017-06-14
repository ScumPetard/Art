<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * 作品类别/时期
 *
 * Class WorkDate
 * @package App\Models
 */
class WorkDate extends Model
{
    protected $table = 'work_dates';

    protected $fillable = ['name','worktype_id'];

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

    public function worktype()
    {
        return $this->belongsTo(WorkType::class,'worktype_id');
    }
}
