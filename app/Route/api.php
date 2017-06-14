<?php


Route::group(['prefix' => 'api', 'namespace' => 'Service'], function () {
    /** Pc 端点击高清图下载 */
    Route::get('/down/big-image/{work_id}','ServiceController@downBigImage');
    Route::get('/down/image/{work_id}','ServiceController@downImage');

    Route::group(['middleware' => 'must.sign'], function () {

        /** PC端收藏作品 */
        Route::post('/favorite','ServiceController@favorite');

        /** 加入购画车 */
        Route::post('/createcart','ServiceController@createCart');

        /** 从购画车中移除 */
        Route::post('/detachcart','ServiceController@detachCart');
    });
});




