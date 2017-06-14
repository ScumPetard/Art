<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 机构客户
 * Class Client
 * @package App\Models
 */
class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'logo',
        'account',
        'password',
        'province',
        'type',
        'version',
        'downloads',
        'buy',
        'end_ip',
        'start_ip'
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

    /** 检查账号是否唯一 */
    public static function checkAccountUnique($str)
    {
        $client = self::where('account',$str)->first();
        if ($client) {
            return true;
        }
        return false;
    }

    /** 获取此机构客户所有Ip */
    public function getAllIp()
    {
        return RealIp::where('client_id',$this->id)->get();
    }

    public function favorite($work_id)
    {
        return ClientFavorite::create([
            'work_id' => $work_id,
            'client_id' => $this->id,
        ]);
    }

    public function detachFavorite($work_id)
    {
        $favorite = ClientFavorite::create([
            'work_id' => $work_id,
            'client_id' => $this->id,
        ]);
        if ($favorite) {
            $favorite->delete();
        }
        return back();
    }

    public function canModule($module_id)
    {
        $check = Oauth::where([
            'client_id' => $this->id,
            'module_id' => $module_id,
        ])->first();
        if ($check) {
            return true;
        }
        return false;
    }
}
