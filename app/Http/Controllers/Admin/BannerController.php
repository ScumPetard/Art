<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class BannerController
 * @package App\Http\Controllers\Admin
 */
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            /** @var select where $where */
            $where = ['is_cat' => 0];
            /** @var select $categorys */
            $categorys = Banner::where($where)->get();
            return view('admin.banner.index', compact('categorys'));
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /** create cat */
    public function createCat(Request $request)
    {
        try {
            /** create banner category */
            Banner::create($request->all());
            return Tools::notifyTo('添加成功', 'admin.banner');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editCat(Request $request, $id)
    {
        try {
            /** remove token */
            unset($request['_token']);
            /** update data */
            Banner::where('id', $id)->update($request->all());
            return Tools::notifyTo('更新成功', 'admin.banner');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }

    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyCat($id)
    {
        try {
            Banner::destroy($id);
            return Tools::notifyTo();
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        try {
            /** @var move and upload $movefile */
            $imageResource = Tools::moveFile($request, 'url', 'banner');
            /** check upload */
            if (!$imageResource) {
                throw new \Exception('文件上传失败');
            }
            $marge = ['is_cat' => $id, 'url' => '/' . $imageResource->file_path];
            /** update info */
            Banner::create(array_merge($request->all(), $marge));
            return Tools::notifyTo('添加成功', '/admin/banner/show/' . $id, false);
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $banners = Banner::where('is_cat', $id)->get();
            $category = Banner::find($id);
            return view('admin.banner.show', compact('banners', 'category'));
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {

            $banner = Banner::find($id);

            $marge = $request->all();

            $imageResource = Tools::moveFile($request, 'url', 'banner');

            if ($imageResource) {
                $marge['url'] = '/' . $imageResource->file_path;
            }

            unset($marge['_token']);

            Banner::where('id', $id)->update($marge);

            return Tools::notifyTo('更新成功', '/admin/banner/show/' . $banner->is_cat, false);

        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Banner::destroy($id);
            return Tools::notifyTo();
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
