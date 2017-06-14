<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Tools\Tools;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function login(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                return view('admin.index.login');
            }

            $attributes = ['email' => $request->get('email'), 'password' => $request->get('password'), 'is_admin' => 1, 'is_enable' => 1,];

            if (Auth::attempt($attributes)) {
                return Tools::notifyTo('Welcome back', 'admin.index');
            }
            throw new \Exception('Login failed');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return Tools::notifyTo('你已经安全退出', 'admin.login');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function index()
    {
        try {
            return view('admin.index.index');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function fileUpload(Request $request)
    {
        /** @var move and upload $movefile */
        $imageResource = Tools::moveFile($request, 'wangEditorH5File', 'wangEditorH5File');

        return '/' . $imageResource->file_path;

    }

}
