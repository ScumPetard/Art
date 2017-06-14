<?php
namespace App\Http\Controllers\Home;

use Excel;
use App\Models\Work;
use App\Tools\Tools;
use App\Models\Member;
use App\Models\RealIp;
use App\Models\Client;
use App\Http\Requests;
use App\Models\ClientCart;
use App\Models\MemberCart;
use Illuminate\Http\Request;
use App\Models\MemberFavorite;
use App\Models\ShopCartRecord;
use App\Models\ClientFavorite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class MemberController extends Controller
{

    /**
     * 登录
     *
     * @param Request $request
     */
    public function sign(Request $request)
    {
//        try {

            /** Get 请求 */
            if ($request->isMethod('get')) {
                return view('home.member.sign');
            }

            /**  POST 请求 $account */

            /** @var 获取输入数据 $account */
            $account = $request->get('account');
            $password = $request->get('password');




            $isClient = false;

            foreach (RealIp::all() as $ip) {
                $startTime = strtotime($ip->client->start_ip);
                $endTime = strtotime($ip->client->end_ip);
                if(Tools::check($ip->ip,$request->getClientIp())
                    && ($startTime < time() && time() < $endTime))
                {
                    Session::put('clientRealIp', $ip->ip);
                    Session::put('clientRealName', $ip->client->name);
                    Session::put('clientId', $ip->client->id);
                    Session::put('clientLogo',$ip->client->logo);
                    $isClient = true;
                }
            }


            if ($isClient) {

                /** @var 拼接查询条件 $where */
                $where = ['account' => $account];

                /** @var 查询会员是否存在 $member */
                $member = Member::where($where)->first();
                /** 如果不存在返回错误信息 */
                if (!$member) {

                    $client = Client::where('account', $account)->first();

                    /** 判断是否存在 如果不存在返回错误信息 */
                    if (!$client) {
                        Session::flash('memberSign_error', '该用户不存在');
                        return back()->withInput();
                    }

                    $startTime = strtotime($client->start_ip);
                    $endTime = strtotime($client->end_ip);
                    if (!($startTime < time() && time() < $endTime)) {
                        Session::flash('memberSign_error', '机构账户已过期');
                        return back()->withInput();
                    }
                    /** 判断密码是否正确 */
                    if (!\Hash::check($password, $client->password)) {
                        Session::flash('memberSign_error', '密码错误 !');
                        return back()->withInput();
                    }

                    /** @var 登录成功 Session 存储 $ip */
                    $ip = $request->getClientIp();
                    Session::put('clientRealIp', $ip);
                    Session::put('clientRealName', $client->name);
                    Session::put('clientId', $client->id);
                    Session::put('client', $client);
                    return redirect('/');

                }

                $startTime = strtotime($member->client->start_ip);
                $endTime = strtotime($member->client->end_ip);
                if (!($startTime < time() && time() < $endTime)) {
                    Session::flash('memberSign_error', '机构账户已过期');
                    return back()->withInput();
                }

                /** 如果密码错误返回错误信息 */
                if (!Hash::check($password, $member->password)) {
                    Session::flash('memberSign_error', '密码错误');
                    return back()->withInput();
                }

                /** 登陆成功 */
                Session::put('member', $member);
                return redirect('/');
            } else {

                /** @var ip不属于机构 查询账号为 @$account的机构 $client */
                $client = Client::where('account', $account)->first();

                /** 判断是否存在 如果不存在返回错误信息 */
                if (!$client) {
                    Session::flash('memberSign_error', '该用户不存在');
                    return back()->withInput();
                }

                $startTime = strtotime($client->start_ip);
                $endTime = strtotime($client->end_ip);
                if (!($startTime < time() && time() < $endTime)) {
                    Session::flash('memberSign_error', '机构账户已过期');
                    return back()->withInput();
                }

                /** 判断密码是否正确 */
                if (!\Hash::check($password, $client->password)) {
                    Session::flash('memberSign_error', '密码错误 !');
                    return back()->withInput();
                }

                /** @var 登录成功 Session 存储 $ip */
                $ip = $request->getClientIp();
                Session::put('clientRealIp', $ip);
                Session::put('clientRealName', $client->name);
                Session::put('clientId', $client->id);
                Session::put('client', $client);
                return redirect('/');
            }


//        } catch (\Exception $exception) {
//            return view('errors.404');
//        }
    }

    /**
     * 退出
     */
    public function signOut()
    {
        Session::flush();
        return redirect('/');
    }

    /**
     * 注册
     *
     * @param Request $request
     */
    public function signUp(Request $request)
    {

        /** Get 返回视图 */
        if ($request->isMethod('get')) {
            return view('home.member.signup');
        }

        /** @var 获取输入信息 $account */
        $account = $request->get('account');
        $password = $request->get('password');
        $confirmpassword = $request->get('confirmpassword');
        $email = $request->get('email');

        /** 判断信息是否完整 */
        if (!$account || !$password || !$confirmpassword || !$email) {
            Session::flash('memberSign_error', '请填写完整信息 !');
            return back()->withInput();
        }

        /** 判断邮箱是否唯一 */
        if (Member::where('email', $email)->first()) {
            Session::flash('memberSign_error', '邮箱已存在 !');
            return back()->withInput();
        }

        /** 判断账号是否唯一 */
        if (Member::where('account', $account)->first() || Client::where('account', $account)->first()) {
            Session::flash('memberSign_error', '账号已存在 !');
            return back()->withInput();
        }

        /** 判断两次密码是否相同 */
        if ($password !== $confirmpassword) {
            Session::flash('memberSign_error', '两次输入密码不同 !');
            return back()->withInput();
        }

        /** @var 获取机构ID $client_id */
        $client_id = Session::get('clientId');

        /** 判断机构ID是否存在 */
        if (!$client_id) {
            Session::flash('memberSign_error', 'IP异常 !');
            return back()->withInput();
        }

        /** @var 创建数组 $data */
        $data = ['account' => $account, 'password' => $password, 'email' => $email, 'client_id' => $client_id,];

        /** @var 创建对象 $member */
        $member = Member::create($data);

        /** 判断是否注册成功 */
        if ($data) {
            Session::flash('memberSign_error', '注册成功 !');
            return redirect('/member/sign');
        } else {
            Session::flash('memberSign_error', '注册失败 !');
            return back()->withInput();
        }
    }

    /** 个人收藏 */
    public function favorite(Request $request)
    {
        try {

            /** 搜索词 */
            $keywords = $request->get('keywords');

            /** 判断登陆的是 Client */
            if (Session::has('client')) {

                /** @var 获取 Client 收藏的所有作品ID $favoriteIds */
                $favoriteIds = ClientFavorite::where(['client_id' => Session::get('client')->id])->lists('work_id');

                /** @var 查询出收藏作品 $favorites */
                $favorites = Work::whereIn('id', $favoriteIds)->paginate(16);
            }

            /** 判断登录的是 Member */
            if (Session::has('member')) {

                /** @var 获取 Member 收藏的所有作品ID $favoriteIds */
                $favoriteIds = MemberFavorite::where(['member_id' => Session::get('member')->id])->lists('work_id');

                /** @var 查询出收藏作品 $favorites */
                $favorites = Work::whereIn('id', $favoriteIds)->paginate(16);
            }

            /** @var 初始化搜索ID $whereId */
            $whereId = [];
            if ($keywords) {

                /** @var 获取搜藏的所有作品 $favorites */
                $favorites = Work::whereIn('id', $favoriteIds)->get();

                /** @var 循环判断是否类似 $favorite */
                foreach ($favorites as $favorite) {

                    /** 如果类似就 Push 进 $whereId */
                    if (strpos($favorite->work_name, $keywords) !== false) {
                        array_push($whereId, $favorite->id);
                    }
                }

                /** @var 返回视图 $favorites */
                $favorites = Work::whereIn('id', $whereId)->paginate(16);
            }


            return view('home.member.favorite', compact('favorites'));

        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    /**
     * 购画车
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory
     * \Illuminate\View\View
     */
    public function cart(Request $request)
    {
        try {

            /** Get 请求 */
            if ($request->isMethod('get')) {
                if (Session::has('client')) {
                    $client_id = Session::get('client')->id;
                    $carts = ClientCart::where(['client_id' => $client_id])->get();
                }

                if (Session::has('member')) {
                    $member_id = Session::get('member')->id;
                    $carts = MemberCart::where(['member_id' => $member_id])->get();
                }
                return view('home.member.cart', compact('carts'));
            }


        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    /**
     * 购画车数量增加
     */
    public function cartAttach($id)
    {
        if (Session::has('client')) {
            $client_id = Session::get('client')->id;
            $where = ['client_id' => $client_id, 'work_id' => $id,];
            $cart = ClientCart::where($where)->first();
            if (!$cart) {
                return back();
            }
            $cart->num += 1;
            $cart->save();
            return back();
        }

        if (Session::has('member')) {
            $member_id = Session::get('member')->id;
            $where = ['member_id' => $member_id, 'work_id' => $id,];
            $cart = MemberCart::where($where)->first();
            if (!$cart) {
                return back();
            }
            $cart->num += 1;
            $cart->save();
            return back();
        }
    }

    /**
     * 减少
     */
    public function cartDetach($id)
    {
        if (Session::has('client')) {
            $client_id = Session::get('client')->id;
            $where = ['client_id' => $client_id, 'work_id' => $id,];
            $cart = ClientCart::where($where)->first();
            if (!$cart) {
                return back();
            }
            if ($cart->num == 1) {
                $cart->delete();
            } else {
                $cart->num -= 1;
                $cart->save();
            }
            return back();
        }

        if (Session::has('member')) {
            $member_id = Session::get('member')->id;
            $where = ['member_id' => $member_id, 'work_id' => $id,];
            $cart = MemberCart::where($where)->first();
            if (!$cart) {
                return back();
            }
            if ($cart->num == 1) {
                $cart->delete();
            } else {
                $cart->num -= 1;
                $cart->save();
            }
            return back();
        }
    }

    /** 导出Excel */
    public function eploadExcel(Request $request)
    {
        $cart_id = $request->get('xls');
        if (!count($cart_id) || count($cart_id) > 200) {
            return Tools::notifyTo('未选择导出项或导出项大于200');
        }

        $cellData = [];
        $cellData[] = ['文件名称', '作品名称', '图片分类', '作者', '购买数量', '国家', '创作时间', '材质', '大小', '作品类型', '创作地点', '收藏机构', '艺术时期'];
        /** 判断是 */
        if (Session::has('client')) {
            $workids = ClientCart::whereIn('id',$cart_id)->lists('work_id');
            $nums = ClientCart::whereIn('id',$cart_id)->get();
        }

        if (!count($workids)) {
            return back();
        }
        $works = Work::whereIn('id', $workids)->get();

        foreach ($works as $work) {
            $work_num = null;
            foreach ($nums as $num) {
                if ($work->id == $num->work_id) {
                    $work_num = $num->num;
                }
            }
            if (is_null($work_num)) {
                return back();
            }
            $resource = [
                $work->file_name,
                $work->work_name,
                $work->worktype->name,
                $work->author->china_name,
                $work_num,
                $work->countries,
                $work->creation_time,
                $work->material,
                $work->size,
                $work->worktype->name,
                $work->creating_location,
                $work->collection_location,
                $work->collection_location,
            ];
            $cellData[] = $resource;
        }
        $filename = '购画车'.time();
        $filepath = 'uploads/xls';
        $data = [
            'client_id' => Session::get('client')->id,
            'file_path' => '/'.$filepath.'/'.$filename.'.xls'
        ];
        ShopCartRecord::create($data);
        Excel::create($filename, function ($excel) use ($cellData) {
            $excel->sheet('score', function ($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });
        })->store('xls',$filepath);
        Excel::create($filename, function ($excel) use ($cellData) {
            $excel->sheet('score', function ($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });
        })->export('xls');
        return back();
    }

    public function resetPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('home.member.resetpassword');
        }

        /** @var 新密码 $new_password */
        $new_password = $request->get('newpassword');
        /** @var 旧密码 $end_password */
        $end_password = $request->get('passworded');

        if(Session::has('client')) {
            $client = Client::find(Session::get('client')->id);
            if(!Hash::check($end_password,$client->password)) {
                Session::flash('memberReset_error', '旧密码错误 !');
                return back();
            }
            if (!isset($new_password[5])) {
                Session::flash('memberReset_error', '密码最少6位 !');
                return back();
            }
            $client->password = bcrypt($new_password);
            $client->save();
            Session::flash('memberReset_error', '修改成功 !');
            return back();
        }

        if(Session::has('member')) {
            $member = Member::find(Session::get('member')->id);
            if(!Hash::check($end_password,$member->password)) {
                Session::flash('memberReset_error', '旧密码错误 !');
                return back();
            }
            if (!isset($new_password[5])) {
                Session::flash('memberReset_error', '密码最少6位 !');
                return back();
            }
            $member->password = $new_password;
            $member->save();
            Session::flash('memberReset_error', '修改成功 !');
            return back();
        }
    }
}
