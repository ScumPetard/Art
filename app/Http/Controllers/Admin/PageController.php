<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        try {
            $pages = Page::all();
            return view('admin.page.index', compact('pages'));
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                return view('admin.page.create');
            }

            Page::create($request->all());

            return Tools::notifyTo('添加成功', 'admin.page.index');

        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function edit(Request $request,$id)
    {
        try {
            if ($request->isMethod('get')) {
                $page = Page::find($id);
                return view('admin.page.edit',compact('page'));
            }

            $data = $request->all();
            unset($data['_token']);
            Page::where('id',$id)->update($data);
            return Tools::notifyTo('修改成功', 'admin.page.index');
        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Page::destroy($id);
            return Tools::notifyTo();
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
