<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Models\WorkDate;
use App\Models\WorkType;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.author.index')->with('authors', Author::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                /* get all work type */
                $worktypes = WorkType::all();

                /** @var get all work date $workdates */
                $workdates = WorkDate::all();

                /** return view */
                return view('admin.author.create', compact('worktypes', 'workdates'));
            }

            /** @var move file and upload $movefile */
            $imageResource = Tools::moveFile($request, 'avatar', 'author_avatar');

            if (!$imageResource) {
                throw new \Exception('上传图片失败');
            }

            /** @var create avatar $marge */
            $marge = ['avatar' => '/' . $imageResource->file_path];

            /* create author */
            Author::create(array_merge($request->all(), $marge));

            return Tools::notifyTo('添加成功', 'admin.author.index');

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
            if ($request->isMethod('get')) {
                /** @var get all work type $worktypes */
                $worktypes = WorkType::all();

                /** @var get all workdate $workdates */
                $workdates = WorkDate::all();

                /** @var get all author $author */
                $author = Author::find($id);

                return view('admin.author.edit', compact('worktypes', 'workdates', 'author'));
            }

            /** @var get all request data $marge */
            $marge = $request->all();

            /** check avatar */
            $imageResource = Tools::moveFile($request, 'avatar', 'author_avatar');

            if ($imageResource) {
                $marge['avatar'] = '/' . $imageResource->file_path;
            }

            /** remove token */
            unset($marge['_token']);

            /** update data */
            Author::where('id', $id)->update($marge);

            return Tools::notifyTo('修改成功', 'admin.author.index');

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
            Author::destroy($id);
            return Tools::notifyTo('删除成功', 'admin.author.index');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
