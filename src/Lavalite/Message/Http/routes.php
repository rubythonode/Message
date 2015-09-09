<?php
Route::get('message', 'Lavalite\Message\Http\Controllers\PublicController@list');
Route::get('message/{slug?}', 'Lavalite\Message\Http\Controllers\PublicController@details');