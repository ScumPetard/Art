<?php

namespace App\Http\Controllers\Home;

use App\Models\Author;
use App\Models\Work;
use Flashy;
use App\Models\Banner;
use App\Models\IndexPictures;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        if (!Tools::canPermession(1)) {
            Flashy::error('您所在机构没有权限访问以下内容，看看其他作品吧');
            return redirect('/member/sign');
        }
        try {
            Tools::clickRecord(1);
            $banners = Banner::where('is_cat', 36)->orderBy('sort', 'desc')->get();
            $pictures = IndexPictures::all();
            return view('home.index.index', compact('banners', 'pictures'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    public function seach(Request $request)
    {
        $key = $request->get('key');
        $works = Work::where('work_name', 'like', '%' . $key . '%')->get();
        $authors = Author::where('china_name', 'like', '%' . $key . '%')->get();
        return view('home.index.seach',compact('works','authors','key'));
    }
}
