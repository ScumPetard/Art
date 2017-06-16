<?php

Route::get('clear', function () {
    Session::flush();
});

Route::get('session', function () {
    dd(Session::all());
});

Route::get('info', function () {
    phpinfo();
});

Route::group(['namespace' => 'Home'], function () {

    Route::any('/member/sign', 'MemberController@sign');

    Route::group(['middleware' => 'must.readip'], function () {
        Route::get('/', 'IndexController@index');

        Route::get('/about/', 'AboutController@about');
        Route::get('/about/statement', 'AboutController@statement');
        Route::get('/about/contact', 'AboutController@contact');
        Route::get('/about/cooperation', 'AboutController@cooperation');
        Route::any('/about/problem', 'AboutController@problem');

        /** 注册 */
        Route::any('/member/signup', 'MemberController@signUp');
        Route::post('/seach','IndexController@seach');
        /** 艺术家首页 */
        Route::any('/artist', 'ArtistController@artist');

        Route::any('/artist/detail/{id}', 'ArtistController@artistDetail');

        Route::get('/artist/{id}/work', 'ArtistController@workList')->name('artist.work.list');


        /** 西方油画首页 */
        Route::any('/westernoilpainting', 'WesternOilPainting@index');

        /** 中国国画首页 */
        Route::any('/chinesepainting', 'ChinesePaintingController@index');

        /** 中国书法 */
        Route::any('/chinesecalligraphy', 'ChineseCalligraphyController@index');

        /** 碑帖古籍 */
        Route::any('/fellancientbooks', 'FellAncientBooksController@index');

        /** 唐卡壁画 */
        Route::any('/mural', 'MuralController@index');

        /** 日本版画 */
        Route::any('/japan', 'JapanController@index');

        /** 印章印谱 */
        Route::any('/seal', 'SealController@index');

        /** 画详情 */
        Route::any('/work-detail/{id}', 'WorkController@detail');

        Route::group(['middleware' => 'must.sign'], function () {
            /** 退出 */
            Route::any('/member/signout', 'MemberController@signOut');

            /** 个人收藏 */
            Route::any('/member/favorite', 'MemberController@favorite');

            /** 购画车 */
            Route::any('/member/cart', 'MemberController@cart');

            /** 增加数量 */
            Route::any('/member/cart/attach/{id}', 'MemberController@cartAttach');

            /** 减少数量 */
            Route::any('/member/cart/detach/{id}', 'MemberController@cartDetach');

            /**  */
            Route::post('/member/cart/excel', 'MemberController@eploadExcel');

            Route::any('/member/resetpassword', 'MemberController@resetPassword');
        });


    });

});

