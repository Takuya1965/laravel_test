<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//以下、ログイン必須ページ
Route::middleware([Authenticate::class])->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/hello', 'HelloController@index');

    Route::get('/logout', 'HelloController@getLogout');

    Route::get('/speach', 'HelloController@speach');
    Route::post('/speach', 'HelloController@doSpeach');

    //ルートパラメータにより、表示プロフィールを決定
    Route::get('/profile/{user_id?}', 'HelloController@profile');

    Route::post('/upload', 'PersonController@upload');
    Route::post('/edit', 'PersonController@edit');

    Route::get('/follow/follows/{followee}', 'FollowController@add');

    Route::get('/search', 'HelloController@search');
    Route::get('/result', 'HelloController@doSearch');
});