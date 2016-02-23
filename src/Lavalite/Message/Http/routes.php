<?php

// Admin routes for module
Route::group(['prefix' => trans_setlocale().'/admin/message', 'middleware' => ['web', 'auth.role:admin']], function () {
     Route::get('/message/sub/{slug}/{id}', 'MessageAdminController@updateSubStatus');
     Route::get('/message/status/{slug}', 'MessageAdminController@updateStatus');
     Route::get('/message/Inbox', 'MessageAdminController@inbox');
     Route::get('/search/{slug?}/{status?}', 'MessageAdminController@search'); 
     Route::get('/status/{status?}','MessageAdminController@showMessage');
     Route::get('/details/{slug}', 'MessageAdminController@getDetails');
     Route::get('/reply/{id}', 'MessageAdminController@reply');
     Route::get('/forward/{id}', 'MessageAdminController@forward');
     Route::resource('/message', 'MessageAdminController');
});

// User routes for module
Route::group(['prefix' => trans_setlocale().'/user/message', 'middleware' => ['web', 'auth.role:user']], function () {
    Route::resource('message', 'MessageUserController');
});

// Public routes for module
Route::group(['prefix' => trans_setlocale().'/user/message', 'middleware' => ['web']], function () {
     Route::get('message', 'MessagePublicController@list');
     Route::get('message/{slug?}', 'MessagePublicController@details');
});
