<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCartRecord;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = ShopCartRecord::all();
        return view('admin.download.index',compact('downloads'));
    }

    public function destroy($id)
    {
        ShopCartRecord::destroy($id);
        return Tools::notifyTo();
    }
}
