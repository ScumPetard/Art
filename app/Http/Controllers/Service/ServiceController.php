<?php

namespace App\Http\Controllers\Service;

use App\Models\Client;
use App\Models\ClientCart;
use App\Models\ClientDownloads;
use App\Models\ClientFavorite;
use App\Models\MemberCart;
use App\Models\MemberDownloads;
use App\Models\MemberFavorite;
use App\Models\Work;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function downBigImage($work_id)
    {
        try {
            /** @var 获取作品 $work */
            $work = Work::find($work_id);

            /** 判断作品是否存在 */
            if (!$work) {
                throw new \Exception('不存在的作品');
            }

            /** 今天0点的时间 */
            $zeroTime = date('Y-m-d 00:00:00', time());

            /** @var 24点的时间 $zeroTime */
            $lastTime = date('Y-m-d 23:59:59', time());


            /** 判断是否是会员账号 */
            if (Session::has('member')) {

                /** @var 获取下载次数 $downloadCount */
                $downloadCount = Session::get('member')->client->downloads;


                /** @var 获取会员ID $id */
                $id = Session::get('member')->id;

                /** @var 获取已下载次数 $count */
                $count = MemberDownloads::whereBetween('created_at', [$zeroTime, $lastTime])->count();

                /** 检查是否超过下载次数 */
                if ($count >= $downloadCount) {
                    return redirect('/');
                }

                /** 创建下载记录 */
                MemberDownloads::create(['member_id' => $id, 'work_id' => $work_id,]);

                /** 返回下载资源 */
                return response()->download(substr($work->big_image, 1));
            }

            /** 判断是否是机构账号 */
            if (Session::has('client')) {

                /** @var 获取下载次数 $downloadCount */
                $downloadCount = Session::get('client')->downloads;

                /** @var 获取机构ID $id */
                $id = Session::get('client')->id;

                /** @var 获取已下载次数 $count */
                $count = ClientDownloads::whereBetween('created_at', [$zeroTime, $lastTime])->count();

                /** 检查是否超过下载次数 */
                if ($count >= $downloadCount) {
                    return redirect('/');
                }

                /** 创建下载记录 */
                ClientDownloads::create(['client_id' => $id, 'work_id' => $work_id,]);

                /** 返回下载资源链接 */
                return response()->download(substr($work->big_image, 1));
            }
            return view('errors.404');
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    /** 用户收藏作品 */
    public function favorite(Request $request)
    {
        try {
            /** @var 获取作品 $work */
            $work = $request->get('work_id');

            /** 判断作品是否存在 */
            if (!$work || !Work::find($work)) {
                return json_encode(['code' => 0, 'message' => '作品不存在']);
            }

            if (Session::has('client')) {
                $id = Session::get('client')->id;
                $where = [
                    'work_id' => $work,
                    'client_id' => $id,
                ];
                if (ClientFavorite::where($where)->first()) {
                    return json_encode(['code' => 0, 'message' => '此作品已添加收藏']);
                }
                ClientFavorite::create($where);
                return json_encode(['code' => 1, 'message' => '添加收藏成功']);
            }

            if (Session::has('member')) {
                $id = Session::get('member')->id;
                $where = [
                    'work_id' => $work,
                    'member_id' => $id,
                ];
                if (MemberFavorite::where($where)->first()) {
                    return json_encode(['code' => 0, 'message' => '此作品已添加收藏']);
                }
                MemberFavorite::create($where);
                return json_encode(['code' => 1, 'message' => '添加收藏成功']);
            }
            return json_encode(['code' => 0, 'message' => '添加收藏成功']);
        } catch (\Exception $exception){
            return json_encode(['code' => 0, 'message' => '服务器错误']);
        }
    }

    /**
     * 用户添加购画车
     * @param $wokr_id
     */
    public function createCart(Request $request)
    {
        try {

            /** @var 获取输入数据 $work_id */
            $work_id = $request->get('work_id');
            $work_num = $request->get('work_num');

            if (Session::has('client')) {
                $client_id = Session::get('client')->id;
                $where = [
                    'work_id' => $work_id,
                    'client_id' => $client_id,
                ];
                $check = ClientCart::where($where)->first();
                if ($check) {
                    return json_encode(['code' => 0, 'message' => '商品已存在购画车']);
                }
                $where = array_merge($where,['num' => $work_num]);
                $cart = ClientCart::create($where);
                if ($cart) {
                    return json_encode(['code' => 1, 'message' => '添加成功']);
                }
                return json_encode(['code' => 0, 'message' => '添加失败']);
            }

//            if (Session::has('member')) {
//                $member_id = Session::get('member')->id;
//
//                $where = [
//                    'work_id' => $work_id,
//                    'member_id' => $member_id,
//                ];
//                $check = MemberCart::where($where)->first();
//
//                if ($check) {
//                    return json_encode(['code' => 0, 'message' => '商品已存在购画车']);
//                }
//                $where = array_merge($where,['num' => $work_num]);
//
//                $cart = MemberCart::create($where);
//                if ($cart) {
//                    return json_encode(['code' => 1, 'message' => '添加成功']);
//                }
//                return json_encode(['code' => 0, 'message' => '添加失败']);
//            }

            return json_encode(['code' => 0, 'message' => '服务器错误']);
        } catch (\Exception $exception){
            return json_encode(['code' => 0, 'message' => '服务器错误']);
        }
    }

    /** 从购画车中移除 */
    public function detachCart(Request $request)
    {
        try {

            /** @var 获取输入数据 $work_id */
            $work_id = $request->get('work_id');

            if (Session::has('client')) {
                $client_id = Session::get('client')->id;
                $where = [
                    'work_id' => $work_id,
                    'client_id' => $client_id,
                ];
                $check = ClientCart::where($where)->first();
                if (!$check) {
                    return json_encode(['code' => 0, 'message' => '购画车中无此商品']);
                }
               $check->delete();
                return json_encode(['code' => 1, 'message' => '删除成功']);
            }

            if (Session::has('member')) {
                $member_id = Session::get('member')->id;

                $where = [
                    'work_id' => $work_id,
                    'member_id' => $member_id,
                ];
                $check = MemberCart::where($where)->first();

                if (!$check) {
                    return json_encode(['code' => 0, 'message' => '购画车中无此商品']);
                }
                $check->delete();
                return json_encode(['code' => 1, 'message' => '删除成功']);
            }

            return json_encode(['code' => 0, 'message' => '服务器错误']);
        } catch (\Exception $exception){
            return json_encode(['code' => 0, 'message' => '服务器错误']);
        }
    }

    public function downImage($work_id)
    {
        try {
            /** @var 获取作品 $work */
            $work = Work::find($work_id);

            /** 判断作品是否存在 */
            if (!$work) {
                throw new \Exception('不存在的作品');
            }
            return response()->download(substr($work->big_image, 1));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }
}
