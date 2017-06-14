<?php

namespace App\Http\Controllers\Home;

use App\Models\Page;
use App\Models\Problem;
use App\Models\User;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /** 关于我们 */
    public function about()
    {
        try {
            $page = Page::find(1);
            return view('home.about.about', compact('page'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    /** 联系我们 */
    public function statement()
    {
        try {
            $page = Page::find(2);
            return view('home.about.about', compact('page'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    /** 联系我们 */
    public function contact()
    {
        try {
            $page = Page::find(3);
            return view('home.about.about', compact('page'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
        if (User::where('name', 'zhangsan')->count()) {
            return true;
        }
        return false;
    }

    /** 商务合作 */
    public function cooperation()
    {
        try {
            $page = Page::find(4);
            return view('home.about.about', compact('page'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    public function problem(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                return view('home.about.problem');
            }
            $attributer = [
                'title' => $request->get('title'),
                'body' => $request->get('body'),
                'ip' => $request->getClientIp(),
            ];
            Problem::create($attributer);
            return json_encode(['message'=>'提交成功,感谢你的反馈']);
        } catch (\Exception $exception) {
            return json_encode(['message'=>'提交失败,请刷新重试']);
        }
    }
}
