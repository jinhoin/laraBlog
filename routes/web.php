<?php

use App\Documentation;

/*
*/

Route::get('/', [
    'as' => '',
    'uses' => 'WelcomeController@index',
]);

Route::get('/home', [
    'as' => '',
    'uses' => 'HomeController@index',
]);

Route::get('/docs/{file?}', function ($file =null){
    $text = new Documentation();
        $text= $text->get($file);
        // dd($text);
        return app(ParsedownExtra::class)->text($text);

});




Route::get('auth/register', [
    'as' => 'users.create',
    'uses' => 'UsersController@create'
]);

            

//기본
Route::post('auth/register', [
    'as' => 'users.store',
    'uses' => 'UsersController@store'
]);

Route::get('auth/confirm/{code}', [
    'as' => 'users.confirm',
    'uses' => 'UsersController@confirm'
]);

// 사용자인증

Route::get('auth/login', [
    'as' => 'sessions.create',
    'uses' => 'SessionsController@create'
]);
Route::post('auth/login', [
    'as' => 'sessions.store',
    'uses' => 'SessionsController@store'
]);
Route::get('auth/logout', [
    'as' => 'sessions.destroy',
    'uses' => 'SessionsController@destroy'
]);

// 비밀번호 초기화
Route::get('auth/remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind'
]);

Route::post('auth/remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind'
]);
Route::get('auth/reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset'
]);

Route::post('auth/reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset'
]);
