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

    }
}