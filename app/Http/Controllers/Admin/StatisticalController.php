<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClickRecord;
use App\Models\Client;
use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StatisticalController extends Controller
{
    public function index()
    {
        $huizong = ClickRecord::all()->groupBy('module_id')->map(function($gate){
            return $gate->count();
        });
        foreach ($huizong->toArray() as $key => $value) {
            $huizong[Module::find($key)->name] = $value;
            unset($huizong[$key]);
        }
        $huizong['汇总'] = collect($huizong)->sum();

        return view('admin.statistical.index')->with('click_groups',ClickRecord::all()
            ->groupBy('click_time')->map(function($gate) {
                return $gate->groupBy('module_id')->map(function ($group) {
                    return $group->count();
                });
            })->map(function ($module){
                foreach ($module->toArray() as $key => $item) {
                    $module[Module::find($key)->name] = $item;
                    unset($module[$key]);
                }
                $module['汇总'] = $module->sum();
                return collect($module);
            })
        )->with('huizong',$huizong)->with('clients',Client::all());
    }


    public function seach(Request $request)
    {
        $huizong = ClickRecord::where('client_id',request('client_id'))
            ->whereBetween('created_at', [request('start'), request('end')])->get()->groupBy('module_id')->map(function($gate){
            return $gate->count();
        });
        foreach ($huizong->toArray() as $key => $value) {
            $huizong[Module::find($key)->name] = $value;
            unset($huizong[$key]);
        }
        if (count($huizong)) {
            $huizong['汇总'] = collect($huizong)->sum();
        }

        return view('admin.statistical.seach')->with('click_groups',ClickRecord::where('client_id',request('client_id'))
            ->whereBetween('created_at', [request('start'), request('end')])->get()
            ->groupBy('click_time')->map(function($gate) {
                return $gate->groupBy('module_id')->map(function ($group) {
                    return $group->count();
                });
            })->map(function ($module){
                foreach ($module->toArray() as $key => $item) {
                    $module[Module::find($key)->name] = $item;
                    unset($module[$key]);
                }
                $module['汇总'] = $module->sum();
                return collect($module);
            })
        )->with('huizong',$huizong)->with('clients',Client::all());

    }

    public function custom(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('admin.statistical.custom')->with('modules',Module::all());
        }
        $data = $request->except('_token');
        $total = 0;
        foreach ($data as $key => $item) {
            $total += $item;
            if (!isset($data[Module::find($key)->name])) {
                $data[Module::find($key)->name] = null;
            }
            $data[Module::find($key)->name] = (int) $item;
            unset($data[$key]);
        }
        $data['total'] = $total;
        return view('admin.statistical.customs',compact('data'));
    }
}
