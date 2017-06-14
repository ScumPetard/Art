<?php

namespace App\Http\Controllers\Admin;

use App\Models\IndexPictures;
use App\Tools\Tools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexPicturesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {

            /** @var move and upload $movefile */
            $imageResource = Tools::moveFile($request, 'cover', 'indexpictures');
            /** check upload */
            if (!$imageResource) {
                throw new \Exception('File upload failed');
            }

            $marge = ['cover' => '/' . $imageResource->file_path];

            /** update info */
            IndexPictures::create(array_merge($request->all(), $marge));

            return Tools::notifyTo('添加成功');

        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $indexpicturess = IndexPictures::all();
            return view('admin.indexpictures.index', compact('indexpicturess'));
        } catch (\Exception $exception){
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

            $banner = IndexPictures::find($id);

            $marge = $request->all();

            $imageResource = Tools::moveFile($request, 'cover', 'indexpictures');

            if ($imageResource) {
                $marge['cover'] = '/' . $imageResource->file_path;
            }

            unset($marge['_token']);

            IndexPictures::where('id', $id)->update($marge);

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
            IndexPictures::destroy($id);
            return Tools::notifyTo();
        } catch (\Exception $exception) {
            return Tools::notifyTo($exception->getMessage());
        }
    }
}
