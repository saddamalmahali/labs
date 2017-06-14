<?php

use Illuminate\Http\Request;

Route::post('/test', function (Request $request){
    return response([1,2,3,4],200);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix'=>'v1', 'middleware'=>'auth:api'], function(){
    Route::get('user-list', 'UserController@get_user_list');
    Route::post('get-user-conversation', 'ChatController@getUserConversationById');
    Route::post('chat-save', 'ChatController@ChatSave');
});
