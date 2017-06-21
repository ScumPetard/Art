<?php
namespace App\Http\Controllers\Mobile;

use App\Models\Banner;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_cat', 36)
            ->orderBy('sort', 'desc')
            ->get();
        return view('mobile.index.index',compact('banners'));
    }
}
