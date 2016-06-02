<?php

Route::group([
    'prefix' => Trans::setLocale() . '/admin/message',
], function () {

    Route::get('/message/sub/{slug}/{id}', 'MessageAdminWebController@updateSubStatus');
    Route::get('/message/status/{slug}', 'MessageAdminWebController@updateStatus');
    // Route::get('/message/Inbox', 'MessageAdminWebController@inbox');
    // Route::get('/compose', 'MessageAdminWebController@compose');
    Route::get('/search/{slug?}/{status?}', 'MessageAdminWebController@search');
    Route::get('/status/{status?}', 'MessageAdminWebController@showMessage');
    Route::get('/details/{caption}/{slug}', 'MessageAdminWebController@getDetails');
    Route::get('/reply/{id}', 'MessageAdminWebController@reply');
    Route::get('/forward/{id}', 'MessageAdminWebController@forward');
    Route::resource('/message', 'MessageAdminWebController');
    Route::get('/important/substatus', 'MessageAdminWebController@changeSubStatus');
});

Route::group([
    'prefix' => Trans::setLocale() . '/user/message',
], function () {
    Route::resource('message', 'MessageUserWebController');
});
