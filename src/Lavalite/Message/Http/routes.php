<?php

Route::group(['prefix' => 'admin'], function () {
    Route::get('/message/message/list', 'Lavalite\Message\Http\Controllers\MessageAdminController@lists');
    Route::resource('/message/message', 'Lavalite\Message\Http\Controllers\MessageAdminController');
});

Route::get('message', 'Lavalite\Message\Http\Controllers\PublicController@list');
Route::get('message/{slug?}', 'Lavalite\Message\Http\Controllers\PublicController@details');
