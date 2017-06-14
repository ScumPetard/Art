<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkType;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $worktypes = WorkType::all();
            return view('admin.worktype.index', compact('worktypes'));
        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {

            WorkType::create($request->all());
            return Tools::notifyTo('添加成功');

        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        try {
            WorkType::where('id',$id)->update(['name' => $request->get('name')]);
            return Tools::notifyTo('修改成功');
        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            WorkType::destroy($id);
            return Tools::notifyTo('删除成功');
        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
