<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Author;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        $works = Author::select(['china_name', 'id'])->get()->map(function ($gate) {
            $gate->work = Tools::getFirstWord($gate->china_name);
            return $gate;
        })->groupBy('work')->map(function ($gate) {
            return $gate->flatten(1);
        })->toArray();
        ksort($works);
        $artists = Author::paginate(12);
        return view('mobile.artist.artist', compact('works','artists'));
    }

    public function loading(Request $request)
    {
        $where = [];
        if (request('work_key')) {
            $artists = Author::where('id',request('work_key'))->paginate(12);
        } else if (!is_null(request('domesticandforeign'))) {
            $artists = Author::where('domesticandforeign',request('domesticandforeign'))->paginate(12);
        } else {
            $artists = Author::paginate(12);
        }
    }
}
