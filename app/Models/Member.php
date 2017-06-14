<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 会员
 * Class Client
 * @package App\Models
 */
class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'account', 'password', 'email', 'client_id'
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function favorite($work_id)
    {
        return MemberFavorite::create([
            'work_id' => $work_id,
            'member_id' => $this->id,
        ]);
    }

    public function detachFavorite($work_id)
    {
        $favorite = MemberFavorite::create([
            'work_id' => $work_id,
            'member_id' => $this->id,
        ]);
        if ($favorite) {
            $favorite->delete();
        }
        return back();
    }

    public function canCat()
    {
        if ($this->client->buy == 1) {
            return true;
        }
        return false;
    }
}
