<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\Problem;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class ProblemController
 * @package App\Http\Controllers\Admin
 */
class ProblemController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.problem.index')->with('problems',Problem::all());
   }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Problem::destroy($id);
        return Tools::notifyTo('删除成功');
   }
}
