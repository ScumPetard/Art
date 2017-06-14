<?php

namespace App\Http\Controllers\Home;

use App\Models\Work;
use App\Models\WorkAndWorkDate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function detail($id)
    {
        try {
            $work = Work::find($id);
            $relatedWorks = Work::where('worktype_id',$work->worktype_id)->get();
            return view('home.work.detail',compact('work','relatedWorks'));
        } catch (\Exception $exception){
            return view('errors.404');
        }
    }
}
