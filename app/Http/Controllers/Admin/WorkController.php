<?php

namespace App\Http\Controllers\Admin;

use Excel;
use App\Models\Author;
use App\Models\ClientCart;
use App\Models\ClientFavorite;
use App\Models\MemberCart;
use App\Models\MemberFavorite;
use App\Models\Work;
use App\Models\WorkAndWorkDate;
use App\Models\WorkDate;
use App\Models\WorkType;
use App\Tools\Tools;
use Illuminate\Http\Request;
use Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $works = Work::orderBy('created_at', 'desc')->get();
            return view('admin.work.index', compact('works'));
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
            if ($request->isMethod('get')) {

                /* get worktype resource */
                $worktypes = WorkType::all();

                /** @var get workdate resource $workdates */
                $workdates = WorkDate::all();

                /** @var get author resource $authors */
                $authors = Author::all();

                /** return view */
                return view('admin.work.create', compact('authors', 'worktypes', 'workdates'));
            }

            /** @var move and upload $movefile */
            $imageResource = Tools::moveFile($request, 'big_image', 'work/big_image');

            /** check upload */
            if (!$imageResource) {
                throw new \Exception('File upload failed');
            }

            /** @var get big image $big_image_path */
            $big_image_path = '/' . $imageResource->file_path;

            /** @var tailoring small image $small_image */
            $small_image = Image::make($imageResource->file_path)
                ->resize(env('IMAGE_SMALL_WIDTH'), env('IMAGE_SMALL_HEIGHT'));

            /** @var small image path $small_image_path */
            $small_image_path = 'uploads/work/small_image/' . time() . $imageResource->file_name;

            /** save small image path */
            $small_image->save($small_image_path);

            /** @var images path array $imagesPath */
            $imagesPath = ['small_image' => '/' . $small_image_path, 'big_image' => $big_image_path,];

            $mages = array_merge($request->all(), $imagesPath);

            /** @var get workdate $workdates */
            $workdates = $mages['workdate_id'];

            unset($mages['workdate_id']);

            unset($mages['_token']);

            /** @var create work $work */
            $work = Work::create($mages);

            if (!$work) {
                throw new \Exception('create work failure');
            }

            /** @var detach workdate $workdate */
            foreach ($workdates as $workdate) {
                WorkAndWorkDate::create(['work_id' => $work->id, 'workdate_id' => $workdate]);
            }

            return Tools::notifyTo('create work a Success', 'admin.work.index');

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
                $work = Work::find($id);
                if ($work) {
                    /* get work type */
                    $worktypes = WorkType::all();

                    /** @var get work date $workdates */
                    $workdates = WorkDate::all();

                    /** @var get author $authors */
                    $authors = Author::all();
                    /** @var get work and workdate Id $workAnWorkDates */
                    $workAnWorkDates = WorkAndWorkDate::where('work_id', $id)->lists('workdate_id');

                    foreach ($workdates as &$workdate) {
                        foreach ($workAnWorkDates as $workAnWorkDate) {
                            if ($workdate->id == $workAnWorkDate) {
                                $workdate->selected = 1;
                            }
                        }
                    }

                    return view('admin.work.edit', compact('work', 'workdates', 'worktypes', 'authors'));
                }
                throw new \Exception('this work not exist');
            }

            $mages = $request->all();

            $imageResource = Tools::moveFile($request, 'big_image', 'work/big_image');

            if ($imageResource) {

                $big_image_path = '/' . $imageResource->file_path;

                $small_image = Image::make($imageResource->file_path)->resize(env('IMAGE_SMALL_WIDTH'), env('IMAGE_SMALL_HEIGHT'));
                $small_image_path = 'uploads/work/small_image/' . time() . $imageResource->file_name;
                $small_image->save($small_image_path);

                $imagesPath = ['small_image' => '/' . $small_image_path, 'big_image' => $big_image_path,];
                $mages = array_merge($mages, $imagesPath);
            }

            $workdates = $mages['workdate_id'];

            unset($mages['workdate_id']);
            unset($mages['_token']);

            Work::where('id', $id)->update($mages);

            WorkAndWorkDate::where('work_id', $id)->delete();

            foreach ($workdates as $workdate) {
                WorkAndWorkDate::create(['work_id' => $id, 'workdate_id' => $workdate]);
            }
            return Tools::notifyTo('update a Success', 'admin.work.index');

        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function batchCreate(Request $request, $id)
    {
//        try {
        if ($request->isMethod('get')) {
            return view('admin.work.batchcreate');
        }

        /** @var get upload images resource $imageResource */
        $imageResource = Tools::moveFile($request, 'file', 'work/big_image');

        /** check is success */
        if (!$imageResource) {
            throw new \Exception('images upload failure');
        }


        /** @var get file name $file_name */
        $file_name = $imageResource->file_name;

        $work_name = substr($file_name, 0, strpos($file_name, '.'));
        /** @var get big image path $big_image_path */
        $big_image_path = $imageResource->file_path;

        /** @var get small image resource $small_image */
        $small_image = Image::make($imageResource->file_path)
            ->resize(env('IMAGE_SMALL_WIDTH'), env('IMAGE_SMALL_HEIGHT'));

        /** @var get small image path $small_image_path */
        $small_image_path = 'uploads/work/small_image/' .time() . str_random() . '.' . $request->file('file')->getClientOriginalExtension();

        /** save resource path */
        $small_image->save($small_image_path);

        $workdate = WorkDate::find($id);
        $workType = $workdate->worktype;


        /** create Work */
        $workResult = Work::create([
            'file_name' => $work_name,
            'work_name' => $work_name,
            'big_image' => '/' . $big_image_path,
            'small_image' => '/' . $small_image_path,
            'is_complete' => 0,
            'worktype_id' => $workType->id,
        ]);

        /** check is success */
        if ($workResult) {
            WorkAndWorkDate::create(['work_id' => $workResult->id, 'workdate_id' => $workdate->id]);
            return 'Success';
        }

        return abort(500);

//        } catch (\Exception $exception) {
//            return abort(500);
//        }
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
            WorkAndWorkDate::where('work_id', $id)->delete();
            Work::destroy($id);
            ClientCart::where('work_id',$id)->delete();
            ClientFavorite::where('work_id',$id)->delete();
            MemberCart::where('work_id',$id)->delete();
            MemberFavorite::where('work_id',$id)->delete();
            return Tools::notifyTo('delete Success');
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $deleteArray = request('workid');
        if (!count($deleteArray)) {
            return Tools::notifyTo('请选择需要删除的数据');
        }
        WorkAndWorkDate::whereIn('work_id', $deleteArray)->delete();
        Work::whereIn('id', $deleteArray)->delete();
        ClientCart::whereIn('work_id', $deleteArray)->delete();
        ClientFavorite::whereIn('work_id', $deleteArray)->delete();
        MemberCart::whereIn('work_id', $deleteArray)->delete();
        MemberFavorite::whereIn('work_id', $deleteArray)->delete();
        return Tools::notifyTo('delete Success');
    }

    public function excelImport(Request $request)
    {

        if ($request->isMethod('get')) {
               return view('admin.work.excelimport');
        }
        try {
            $excel = $request->file('excel');
            $filePath = $excel->getRealPath();
            Excel::load($filePath, function($reader) {
                $excelData = $reader->all();
                foreach ($excelData as $excelDatum) {
                    $work = Work::find((int) $excelDatum['作品']);
                    if ($work) {
                        $workdate =  @explode('-',@$excelDatum['作品分类时期']);
                        @WorkAndWorkDate::where('work_id', $work->id)->delete();
                        foreach ($workdate as $wor) {
                            @WorkAndWorkDate::create(['work_id' => $work->id, 'workdate_id' => $wor]);
                        }
                        if (@$excelDatum['作品名称']) {
                            $work->work_name = @$excelDatum['作品名称'];
                        }

                        if ((int) @$excelDatum['作者'] ) {
                            $work->author_id = (int) @$excelDatum['作者'];
                        }

                        if (@$excelDatum['国家']) {
                            $work->countries = @$excelDatum['国家'];
                        }

                        if (@$excelDatum['创作时间']) {
                           $work->creation_time = @$excelDatum['创作时间'];
                        }

                        if (@$excelDatum['材质']) {
                            $work->material = @$excelDatum['材质'];
                        }

                        if (@$excelDatum['大小']) {
                            $work->size = @$excelDatum['大小'];
                        }

                        if ((int) @$excelDatum['作品类型']) {
                            $work->worktype_id = (int) @$excelDatum['作品类型'];
                        }

                        if (@$excelDatum['创作地点']) {
                            $work->creating_location = @$excelDatum['创作地点'];
                        }

                        if (@$excelDatum['收藏地址']) {
                            $work->collection_location = @$excelDatum['收藏地址'];
                        }

                        if (@$excelDatum['简介']) {
                            $work->intro = @$excelDatum['简介'];
                        }

                        if ((int) @$excelDatum['完成']) {
                            $work->is_complete = (int) @$excelDatum['完成'];
                        }

                        @$work->save();

                    }
                }
            });
            return Tools::notifyTo('录入成功');
        } catch (\Exception $exception) {
            return Tools::notifyTo('录入失败');
        }
    }
}
