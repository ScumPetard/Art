<?php
namespace App\Tools;

use App\Models\ClickRecord;
use Image;
use Illuminate\Support\Facades\Session;

class Tools
{
    public static function notifyTo($message = '操作成功', $path = null, $status = true)
    {
        try {

            Session::flash('notify_message', $message);

            if ($status) {
                if (is_null($path)) {
                    return back()->withInput();
                }

                return redirect()->route($path);
            }

            return redirect($path);

        } catch (\Exception $exception) {
            return back();
        }
    }

    public static function moveFile($request, $filename, $path)
    {
        try {
            if (!$request->hasFile($filename)) {
                return false;
            }

            $resource = new \stdClass();

            /** @var file Name $file_name */
            $resource->file_name = $request->file($filename)->getClientOriginalName();

            $request->file($filename)->move('uploads/' . $path, time() . $resource->file_name);
            $resource->file_path = 'uploads/' . $path . '/' . time() . $resource->file_name;
            return $resource;
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public static function tailoring($filepath, $width, $height = null)
    {
        try {

            if (is_null($height)) {
                $image = Image::make($filepath)->fit($width);
            } else {
                $image = Image::make($filepath)->resize($width, $height);
            }

            $result = $image->save($filepath);

        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public static function getFirstWord($str)
    {
        if (empty($str)) {
            return '';
        }

        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z'))
        {
            return strtoupper($str{0});
        }

        $s1 = iconv('UTF-8', 'gbk//IGNORE', $str);

        $s2 = iconv('gbk', 'UTF-8//IGNORE', $s1);
        $s = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;

        if ($asc >= -20319 && $asc <= -20284)
            return 'A';
        if ($asc >= -20283 && $asc <= -19776)
            return 'B';
        if ($asc >= -19775 && $asc <= -19219)
            return 'C';
        if ($asc >= -19218 && $asc <= -18711)
            return 'D';
        if ($asc >= -18710 && $asc <= -18527)
            return 'E';
        if ($asc >= -18526 && $asc <= -18240)
            return 'F';
        if ($asc >= -18239 && $asc <= -17923)
            return 'G';
        if ($asc >= -17922 && $asc <= -17418)
            return 'H';
        if ($asc >= -17417 && $asc <= -16475)
            return 'J';
        if ($asc >= -16474 && $asc <= -16213)
            return 'K';
        if ($asc >= -16212 && $asc <= -15641)
            return 'L';
        if ($asc >= -15640 && $asc <= -15166)
            return 'M';
        if ($asc >= -15165 && $asc <= -14923)
            return 'N';
        if ($asc >= -14922 && $asc <= -14915)
            return 'O';
        if ($asc >= -14914 && $asc <= -14631)
            return 'P';
        if ($asc >= -14630 && $asc <= -14150)
            return 'Q';
        if ($asc >= -14149 && $asc <= -14091)
            return 'R';
        if ($asc >= -14090 && $asc <= -13319)
            return 'S';
        if ($asc >= -13318 && $asc <= -12839)
            return 'T';
        if ($asc >= -12838 && $asc <= -12557)
            return 'W';
        if ($asc >= -12556 && $asc <= -11848)
            return 'X';
        if ($asc >= -11847 && $asc <= -11056)
            return 'Y';
        if ($asc >= -11055 && $asc <= -10247)
            return 'Z';
        return null;
    }

    public static function clickRecord($module_id)
    {
        if (Session::has('client')) {
            ClickRecord::create([
                'type' => '机构账号',
                'name' => Session::get('client')->name,
                'module_id' => $module_id,
                'click_time' => date('Y-m',time()),
            ]);
        }
        if (Session::has('member')) {
            ClickRecord::create([
                'type' => '个人账号',
                'name' => Session::get('member')->account,
                'module_id' => $module_id,
                'click_time' => date('Y-m',time()),
            ]);
        }
    }

    public static function check($ipStr, $checkip)
    {
        $ipArray = explode('-', $ipStr);
        $ip_start = static::get_iplong($ipArray[0]);
        $ip_end = static::get_iplong($ipArray[1]);
        $checkip = static::get_iplong($checkip);
        if ($checkip >= $ip_start && $checkip <= $ip_end) {
            return true;
        } else {
            return false;
        }

    }

    public static function get_iplong($ip)
    {
        return bindec(decbin(ip2long($ip)));
    }
}