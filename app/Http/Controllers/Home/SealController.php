<?php

namespace App\Http\Controllers\Home;

use App\Models\Author;
use App\Models\Banner;
use App\Models\Work;
use App\Models\WorkAndWorkDate;
use App\Models\WorkDate;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 印章印谱
 * Class SealController
 * @package App\Http\Controllers\Home
 */
class SealController extends Controller
{
    public function index(Request $request)
    {
        try {
            Tools::clickRecord(7);
            /** @var 轮播图 $banners */
            $banners = Banner::where('is_cat', 41)->orderBy('sort', 'desc')->get();

            /** @var 作品时期 $workdates */
            $workdates = WorkDate::where('worktype_id', 6)->get();

            /** 作者 */
            $artists = Author::where('worktype_id', 6)->get();

            /** @var first word sort array $takeSport */
            $takeSport = [];

            /** @var sort array $artist */
            foreach ($artists as $artist) {
                $artist = $artist->toArray();
                $artist['is_english'] = 0;

                $chinaFirstWord = Tools::getFirstWord($artist['china_name']);

                if (!array_key_exists($chinaFirstWord, $takeSport)) {
                    $takeSport[$chinaFirstWord] = [];
                    array_push($takeSport[$chinaFirstWord], $artist);
                } else {
                    array_push($takeSport[$chinaFirstWord], $artist);
                }

            }

            /** @var english name foreach $artist */
            foreach ($artists as $artist) {
                $artist = $artist->toArray();
                $artist['is_english'] = 1;
                $foreign_name = strtoupper(substr($artist['foreign_name'], 0, 1));
                if (!array_key_exists($foreign_name, $takeSport)) {
                    $takeSport[$foreign_name] = [];
                    array_push($takeSport[$foreign_name], $artist);
                } else {
                    array_push($takeSport[$foreign_name], $artist);
                }
            }

            ksort($takeSport);


            $keywords = $request->get('keywords');
            $author_id = $request->get('authorid');
            $workdate_id = $request->get('workdate');


            /**
             * 搜索条件
             */
            $where = [];

            /** 作品 */

            if ($keywords) {
                $where['keywords'] = $keywords;
                $works = Work::where('work_name', 'like', '%' . $keywords . '%')->where('worktype_id', 6)->orderBy('created_at','desc')->paginate(16);
            } elseif ($author_id) {
                $where['authorid'] = $author_id;
                $works = Work::where('author_id', $author_id)->where('worktype_id', 6)->orderBy('created_at','desc')->paginate(16);
            } elseif ($workdate_id) {
                $where['workdate'] = $workdate_id;
                $workids = WorkAndWorkDate::where('workdate_id', $workdate_id)->lists('work_id');
                $works = Work::where('worktype_id', 6)->whereIn('id', $workids)->orderBy('created_at','desc')->paginate(16);
            } else {
                $works = Work::where('worktype_id', 6)->orderBy('created_at','desc')->paginate(16);
            }

            return view('home.seal.index', compact('banners', 'workdates', 'works', 'takeSport', 'where'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }
}
