<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $modules = Module::all();
            return view('admin.module.index', compact('modules'));
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
            Module::create($request->all());
            return Tools::notifyTo('add A Success');
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
            unset($request['_token']);
            Module::where('id', $id)->update($request->all());
            return Tools::notifyTo('修改成功');
        } catch (\Exception $exception){
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
            Module::destroy($id);
            return Tools::notifyTo('删除成功');
        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
