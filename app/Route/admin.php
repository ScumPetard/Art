<?php


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    /** 登录 */
    Route::any('/', 'IndexController@login')->name('admin.login');

    /** 文件上传 */
    Route::any('/api/fileupload', 'IndexController@fileUpload');

    /** 登出 */
    Route::get('/logout', 'IndexController@logout')->name('admin.logout');

    Route::group(['middleware' => 'must.admin'], function () {

        /** 首页 */
        Route::get('/index','IndexController@index')->name('admin.index');



        /* --------------- 轮播图管理 --------------- */

        /** 轮播图栏目 */
        Route::get('/banner','BannerController@index')->name('admin.banner');

        /** 添加轮播图栏目 */
        Route::any('/banner/createcat','BannerController@createCat')->name('admin.banner.createcat');

        /** 编辑轮播图栏目 */
        Route::any('/banner/editcat/{id}','BannerController@editCat')->name('admin.banner.editcat');

        /** 删除轮播图栏目 */
        Route::any('/banner/destroycat/{id}','BannerController@destroyCat')->name('admin.banner.destroycat');

        /** 轮播图下级栏目 */
        Route::any('/banner/show/{id}','BannerController@show')->name('admin.banner.show');

        /** 添加轮播图 */
        Route::any('/banner/create/{id}','BannerController@create')->name('admin.banner.create');

        /** 编辑轮播图 */
        Route::any('/banner/edit/{id}','BannerController@edit')->name('admin.banner.edit');

        /** 删除轮播图 */
        Route::any('/banner/destroy/{id}','BannerController@destroy')->name('admin.banner.destroy');

        /* --------------- 轮播图管理 --------------- */



        /* --------------- 管理员管理 --------------- */

        /* 管理员管理 */
        Route::get('/admin','AdminController@index')->name('admin.admin.index');

        /** 添加管理员 */
        Route::post('/admin/create','AdminController@create')->name('admin.admin.create');

        /* 编辑管理员 */
        Route::post('/admin/edit/{id}','AdminController@edit')->name('admin.admin.edit');

        /* 删除管理员 */
        Route::get('/admin/destroy/{id}','AdminController@destroy')->name('admin.admin.destroy');
        /* --------------- 管理员管理 --------------- */



        /* --------------- 权限管理 --------------- */

        /* 权限管理首页 */
        Route::get('/permission','PermissionController@index')->name('admin.permission.index');

        /* 添加权限 */
        Route::post('/permission/create','PermissionController@create')->name('admin.permission.create');

        /* 编辑权限 */
        Route::post('/permission/edit/{id}','PermissionController@edit')->name('admin.permission.edit');

        /* 删除权限 */
        Route::get('/permission/destroy/{id}','PermissionController@destroy')->name('admin.permission.destroy');

        /* --------------- 权限管理 --------------- */



        /* --------------- 作品类型管理 --------------- */

        /* 首页 */
        Route::get('/worktype','WorkTypeController@index')->name('admin.worktype.index');


        /* 添加 */
        Route::post('/worktype/create','WorkTypeController@create')->name('admin.worktype.create');

        /* 编辑 */
        Route::post('/worktype/edit/{id}','WorkTypeController@edit')->name('admin.worktype.edit');

        /* 删除 */
        Route::get('/worktype/destroy/{id}','WorkTypeController@destroy')->name('admin.worktype.destroy');

        /* --------------- 作品类型管理 --------------- */

        /* --------------- 作品分类/时期管理 --------------- */

        /* 首页 */
        Route::get('/workdate','WorkDateController@index')->name('admin.workdate.index');


        /* 添加 */
        Route::post('/workdate/create','WorkDateController@create')->name('admin.workdate.create');

        /* 编辑 */
        Route::post('/workdate/edit/{id}','WorkDateController@edit')->name('admin.workdate.edit');

        /* 删除 */
        Route::get('/workdate/destroy/{id}','WorkDateController@destroy')->name('admin.workdate.destroy');

        /* --------------- 作品分类/时期管理 --------------- */


        /* --------------- 作者管理 --------------- */

        /* 首页 */
        Route::get('/author','AuthorController@index')->name('admin.author.index');

        /* 添加 */
        Route::any('/author/create','AuthorController@create')->name('admin.author.create');

        /** 编辑 */
        Route::any('/author/edit/{id}','AuthorController@edit')->name('admin.author.edit');

        /* 删除 */
        Route::get('/author/destroy/{id}','AuthorController@destroy')->name('admin.author.destroy');



        /* --------------- 作者管理 --------------- */


        /* --------------- 机构客户管理 --------------- */

        /** 首页 */
        Route::get('/client','ClientController@index')->name('admin.client.index');

        /** 添加 */
        Route::post('/client/create','ClientController@create')->name('admin.client.create');

        /** 编辑 */
        Route::post('/client/edit/{id}','ClientController@edit')->name('admin.client.edit');

        /** 删除 */
        Route::get('/client/destroy/{id}','ClientController@destroy')->name('admin.client.destroy');

        /* --------------- 机构客户管理 --------------- */

        /* --------------- 作品管理 --------------- */

        /** 首页 */
        Route::get('/work','WorkController@index')->name('admin.work.index');


        /** 添加 */
        Route::any('/work/create','WorkController@create')->name('admin.work.create');

        /** 批量添加作品 */
        Route::any('/work/batchcreate/{id}','WorkController@batchCreate')->name('admin.work.batchcreate');

        /** 编辑 */
        Route::any('/work/edit/{id}','WorkController@edit')->name('admin.work.edit');

        /** 删除 */
        Route::any('/work/destroy/{id}','WorkController@destroy')->name('admin.work.destroy');

        /* --------------- 作品管理 --------------- */



        /* --------------- 机构客户管理 --------------- */

        /** 首页 */
        Route::get('/page','PageController@index')->name('admin.page.index');

        /** 添加 */
        Route::any('/page/create','PageController@create')->name('admin.page.create');

        /** 编辑 */
        Route::any('/page/edit/{id}','PageController@edit')->name('admin.page.edit');

        /** 删除 */
        Route::get('/page/destroy/{id}','PageController@destroy')->name('admin.page.destroy');

        /* --------------- 机构客户管理 --------------- */


        /* --------------- 首页信息管理 --------------- */

        /** 首页信息 */
        Route::any('/indexpictures','IndexPicturesController@index')->name('admin.indexpictures.show');

        /** 添加首页信息 */
        Route::any('/indexpictures/create','IndexPicturesController@create')->name('admin.indexpictures.create');

        /** 编辑首页信息 */
        Route::any('/indexpictures/edit/{id}','IndexPicturesController@edit')->name('admin.indexpictures.edit');

        /** 删除首页信息 */
        Route::any('/indexpictures/destroy/{id}','IndexPicturesController@destroy')->name('admin.indexpictures.destroy');

        /* --------------- 轮播图管理 --------------- */

        /* --------------- 模块管理 --------------- */

        /** 模块 */
        Route::any('/module','ModuleController@index')->name('admin.module.show');

        /** 添加模块 */
        Route::any('/module/create','ModuleController@create')->name('admin.module.create');

        /** 编辑模块 */
        Route::any('/module/edit/{id}','ModuleController@edit')->name('admin.module.edit');

        /** 删除模块 */
        Route::any('/module/destroy/{id}','ModuleController@destroy')->name('admin.module.destroy');

        /* --------------- 会员管理 --------------- */
        Route::any('/member','MemberController@index')->name('admin.member.index');
        /** 编辑会员 */
        Route::any('/member/edit/{id}','MemberController@edit')->name('admin.member.edit');

        Route::any('/member/destroy/{id}','MemberController@destroy')->name('admin.member.destroy');

        /** 统计 */
        Route::any('/statistical','StatisticalController@index')->name('admin.statistical.index');
        Route::post('/statistical/seach','StatisticalController@seach')->name('admin.statistical.seach');

        /** 首页信息 */
        Route::any('/indexpictures','IndexPicturesController@index')->name('admin.indexpictures.show');


        Route::any('/problem','ProblemController@index')->name('admin.problem.index');
        Route::any('/problem/destroy/{id}','ProblemController@destroy')->name('admin.problem.destroy');

        /**___________下载记录___________/__**/
        Route::any('/download','DownloadController@index')->name('admin.download.index');
        Route::any('/download/destroy/{id}','DownloadController@destroy')->name('admin.download.destroy');
    });

});

