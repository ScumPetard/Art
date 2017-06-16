<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * 作者
 *
 * Class WorkDate
 * @package App\Models
 * ------ gender ------
 * 1 => 男
 * 0 => 女
 */
class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'file_name',
        'china_name',
        'foreign_name',
        'alias_name',
        'gender',
        'nationality',
        'born',
        'birth_date',
        'death_address',
        'death',
        'art_features',
        'art_genre',
        'art_date',
        'impact',
        'motto',
        'avatar',
        'achievement',
        'evaluation',
        'intro',
        'worktype_id',
        'workdate_id',
        'domesticandforeign'
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

    public function worktype()
    {
        return $this->belongsTo(WorkType::class,'worktype_id');
    }

    public function workdate()
    {
        return $this->belongsTo(WorkDate::class,'workdate_id');
    }
}
