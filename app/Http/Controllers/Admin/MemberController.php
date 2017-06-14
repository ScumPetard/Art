<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.member.index',compact('members'));
    }

    public function edit(Request $request,$id)
    {
        $email = $request->get('email');
        $account = $request->get('account');
        $password = $request->get('password');
        $member = Member::find($id);
        if (!$member) {
            return Tools::notifyTo('不存在的用户');
        }
        if ($member->account !== $account) {
            if (Member::where('account' , $account)->first()){
                return Tools::notifyTo('用户名已存在');
            }
        }
        $member->account = $account;
        $member->email = $email;
        if ($password) {
            $member->password = $password;
        }
        $member->save();
        return Tools::notifyTo('修改成功');
    }

    public function destroy($id)
    {
        Member::destroy($id);
        return Tools::notifyTo('删除成功');
    }
}
