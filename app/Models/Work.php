<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 作品
 * Class Client
 * @package App\Models
 */
class Work extends Model
{
    protected $table = 'works';

    protected $fillable = [
        'file_name',
        'work_name',
        'author_id',
        'countries',
        'creation_time',
        'material',
        'size',
        'worktype_id',
        'workdate_id',
        'creating_location',
        'collection_location',
        'small_image',
        'big_image',
        'qrcode',
        'intro',
        'is_complete'
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
        return $this->belongsTo(WorkType::class, 'worktype_id');
    }

    public function can($workdate_id)
    {
        return WorkAndWorkDate::where([
            'work_id' => $this->id,
            'workdate_id' => $workdate_id
        ])->first() ? true : false;
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function workdate()
    {
        $workdates = WorkDate::whereIn('id',WorkAndWorkDate::where('work_id', $this->id)->lists('workdate_id')->toArray())->get();
        if(count($workdates)) {
            return $workdates;
        }
        return null;
    }
}
