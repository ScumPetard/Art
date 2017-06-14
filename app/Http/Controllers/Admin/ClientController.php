<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Module;
use App\Models\Oauth;
use App\Models\RealIp;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $clients = Client::all();
            $modules = Module::all();
            return view('admin.client.index', compact('clients','modules'));
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
            if (Client::checkAccountUnique($request->get('account'))) {
                throw new \Exception('此账户已存在!');
            }

            $modules = $request->get('module');


            $ips = trim($request->get('ips'));
            $ipsArray = $result = preg_split('/[;\r\n]+/s', $ips);
            if (count($ipsArray)) {
                if (count($ipsArray) != count(array_unique($ipsArray))) {
                    throw new \Exception('输入IP重复,请重试~');
                }
            }
            foreach ($ipsArray as $item) {
                $clientIp = RealIp::where('ip',$item)->first();
                if ($clientIp) {
                    throw new \Exception("此IP已存在,重复机构为{$clientIp->client->name}");
                }
            }

            /** @var move and upload $movefile */
            $imageResource = Tools::moveFile($request, 'logo', 'client_logo');

            /** check upload */
            if (!$imageResource) {
                throw new \Exception('File upload failed');
            }

            /** @var 获取输入所有信息 $dataArray */
            $dataArray = $request->all();

            /** 销毁掉IP信息 */
            unset($dataArray['ips']);
            unset($dataArray['module']);

            /** @var 创建Client对象 $client */
            $client = Client::create(array_merge($dataArray, ['logo' => '/' . $imageResource->file_path]));

            if (!$client) {
                throw new \Exception('创建机构客户失败~');
            }

            if(count($ipsArray)) {
                if (count($ipsArray) != count(array_unique($ipsArray))) {
                    throw new \Exception('输入IP重复,请重试~');
                }
                foreach ($ipsArray as $item) {
                    RealIp::create([
                        'ip' => $item,
                        'client_id' => $client->id,
                    ]);
                }
            }
            if (count($modules)) {
                foreach ($modules as $module) {
                    Oauth::create([
                        'module_id' => $module,
                        'client_id' => $client->id,
                    ]);
                }
            }
            return Tools::notifyTo('创建成功');
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

            $client = Client::find($id);

            if (!$client) {
                throw new \Exception('此用户不存在');
            }

            if ($request->get('account') !== $client->account) {
                if (Client::checkAccountUnique($request->get('account'))) {
                    throw new \Exception('此账户已存在!');
                }
            }

            $marge = $request->all();
            $modules = $request->get('module');
            $imageResource = Tools::moveFile($request, 'logo', 'client_logo');

            if ($imageResource) {
                $marge['logo'] = '/' . $imageResource->file_path;
            }

            if (!$request->get('password')) {
                unset($marge['password']);
            } else {
                $marge['password'] = bcrypt($marge['password']);
            }

            unset($marge['_token']);

            /** @var 获取输入IP地址 $ips */
            $ips = trim($request->get('ips'));

            $ipsArray = $result = preg_split('/[;\r\n]+/s', $ips);
            foreach ($ipsArray as $item) {
                $clientIp = RealIp::where('ip',$item)->first();
                if ( $clientIp->client->id != $id) {
                    throw new \Exception("此IP已存在,重复机构为{$clientIp->client->name}");
                }
            }

            /** 销毁掉IP信息 */
            unset($marge['ips']);
            unset($marge['module']);

            Client::where('id', $id)->update($marge);

            RealIp::where('client_id',$id)->delete();

            if(count($ipsArray)) {
                if (count($ipsArray) != count(array_unique($ipsArray))) {
                    throw new \Exception('输入IP重复,请重试~');
                }
                foreach ($ipsArray as $item) {
                    RealIp::create([
                        'ip' => $item,
                        'client_id' => $id,
                    ]);
                }
            }
            Oauth::where(['client_id' => $client->id])->delete();

            if (count($modules)) {
                foreach ($modules as $module) {
                    Oauth::create([
                        'module_id' => $module,
                        'client_id' => $client->id,
                    ]);
                }
            }
            return Tools::notifyTo('update A Success');
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
            Client::destroy($id);
            RealIp::where('client_id',$id)->delete();
            return Tools::notifyTo('delete A Success');
        } catch (\Exception $exception){
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
