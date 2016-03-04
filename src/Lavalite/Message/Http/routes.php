<?php

Route::group(
[
'prefix' => Trans::setLocale().'/admin/message'
],
function () {
   
     Route::get('/message/sub/{slug}/{id}', 'MessageAdminController@updateSubStatus');
     Route::get('/message/status/{slug}', 'MessageAdminController@updateStatus');
     // Route::get('/message/Inbox', 'MessageAdminController@inbox');
     // Route::get('/compose', 'MessageAdminController@compose');
     Route::get('/search/{slug?}/{status?}', 'MessageAdminController@search'); 
     Route::get('/status/{status?}','MessageAdminController@showMessage');
     Route::get('/details/{caption}/{slug}', 'MessageAdminController@getDetails');
     Route::get('/reply/{id}', 'MessageAdminController@reply');
     Route::get('/forward/{id}', 'MessageAdminController@forward');
     Route::resource('/message', 'MessageAdminController');
     Route::get('/important/substatus', 'MessageAdminController@changeSubStatus');
});

Route::group(
[
'prefix' => Trans::setLocale().'/user/message'
],
function () {
    Route::resource('message', 'MessageUserController');
});


Route::get('message', 'MessagePublicController@list');
Route::get('message/{slug?}', 'MessagePublicController@details');
