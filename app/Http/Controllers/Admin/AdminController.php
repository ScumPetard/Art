<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Tools\Tools;
use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            /* get admin resource */
            $admins = User::where('is_admin', 1)->get();

            /* get permission resource */
            $permissions = Permission::all();

            /* return view */
            return view('admin.admin.index', compact('admins', 'permissions'));

        } catch (\Exception $exception) {
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
            /** @var check input email Whether or not the only $checkEmailUnique */
            $checkEmailUnique = User::where('email', $request->get('email'))->first();

            /** check email only */
            if ($checkEmailUnique) {
                throw new \Exception('此Email已被使用,请更换Email');
            }

            /** @var check image upload $imageResource */
            $imageResource = Tools::moveFile($request, 'avatar', 'admin_avatar');

            if (!$imageResource) {
                throw new \Exception('图片上传失败');
            }

            /** tailoring image */
            Tools::tailoring($imageResource->file_path, 200);

            /* create resource array */
            $arrtbue = [
                'avatar' => '/' . $imageResource->file_path,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'is_enable' => $request->get('is_enable'),
                'is_admin' => 1
            ];

            /* create admin resource */
            $admin = User::create($arrtbue);

            /** check admin existing */
            if (!$admin) {
                throw new \Exception('创建管理员失败');
            }

            /** @var get selected permission $permissions */
            $permissions = $request->get('permission');

            /* foreach to give permission */
            foreach ($permissions as $permission) {
                $admin->attachPermission($permission);
            }

            return Tools::notifyTo('添加成功');

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
            /* get admin resource */
            $admin = User::find($id);

            /* detach all permissions */
            $admin->detachAllPermissions();

            /** @var get selected permission $permissions */
            $permissions = $request->get('permission');

            /* to give all permission */
            foreach ($permissions as $permission) {
                $admin->attachPermission($permission);
            }

            /* update admin */
            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            $admin->is_enable = $request->get('is_enable');

            /* check password is change */
            if ($request->get('password')) {
                $admin->password = $request->get('password');
            }

            /* check avatar is change */
            $imageResource = Tools::moveFile($request, 'avatar', 'admin_avatar');
            if ($imageResource) {
                Tools::tailoring($imageResource->file_path, 200);
                $admin->avatar = '/' . $imageResource->file_path;
            }

            /* save */
            $admin->save();

            return Tools::notifyTo('更新成功');

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
            /* Whether the administrator is the current administrator */
            if (\Auth::user()->id == $id) {
                throw new \Exception('你不能删除自己');
            }

            /* get admin resource */
            $admin = User::find($id);

            /* Remove All Permissions */
            $admin->detachAllPermissions();

            /* delete admin */
            $admin->delete();

            return Tools::notifyTo('删除成功');

        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }

    }

}
