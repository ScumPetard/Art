<?php

namespace App\Http\Controllers\Home;

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
        try {
            Tools::clickRecord(1);
            $banners = Banner::where('is_cat',36)->orderBy('sort','desc')->get();
            $pictures = IndexPictures::all();
            return view('home.index.index',compact('banners','pictures'));
        } catch (\Exception $exception){
            return view('errors.404');
        }
   }
}
