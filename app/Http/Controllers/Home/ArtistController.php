<?php

namespace App\Http\Controllers\Home;

use App\Models\Author;
use App\Models\Work;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 艺术家Controller
 * Class ArtistController
 * @package App\Http\Controllers\Home
 */
class ArtistController extends Controller
{
    /** 艺术家首页 */
    public function artist(Request $request)
    {
        Tools::clickRecord(10);
        try {

            $keywords = $request->get('keywords');

            $seachArray = [];

            if (!$keywords) {
                $where = [];

                $authorid = $request->get('authorid');

                $authorclass = $request->get('authorclass');

                if ($authorid) {
                    $seachArray['authorid'] = $authorid;
                    $where['id'] = $authorid;
                }

                if (!is_null($authorclass)) {
                    $seachArray['authorclass'] = $authorclass;
                    $where['domesticandforeign'] = $authorclass;

                }

                /** @var get all artist $artists */
                $authors = Author::where($where)->paginate(16);


            } else {
                $seachArray['keywords'] = $keywords;
                $authors = Author::paginate(200);
                $arrayid = [];
                foreach ($authors as &$author)
                {
                    if (strpos($author->china_name,$keywords) !== false)
                    {
                        array_push($arrayid,$author->id);
                    }
                    if (strpos($author->foreign_name,$keywords) !== false)
                    {
                        array_push($arrayid,$author->id);
                    }
                }
                $authors = Author::whereIn('id',$arrayid)->paginate(16);
            }

            $artists = Author::all();

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

            return view('home.artist.index', compact('takeSport', 'artists', 'authors','seachArray'));
        } catch (\Exception $exception) {
            return view('errors.404');
        }
    }

    public function artistDetail($id)
    {
        try {
            $artist = Author::find($id);
            $relatedWorks = Work::where('author_id',$id)->limit(8)->get();
            return view('home.artist.detail',compact('artist','relatedWorks'));
        } catch (\Exception $exception){
            return view('errors.404');
        }
    }
}
