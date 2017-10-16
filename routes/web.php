<?php

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

Route::group(['namespace' => 'Admin'], function () {
    // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
    Route::get('/home', 'HomeController@index')->name('home');

    //发布问题 资源路由
    Route::resource('questions', 'QuestionController', ['names' => [
        'create' => 'question.create',
        'show'   => 'question.show',
    ]]);
    Route::post('questions/{question}/answer', 'AnswerController@store');
    //Route::get('email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify']);
});

Route::group(['prefix' => 'everan', 'namespace' => 'Index', 'middleware' => ['web']], function () {
    Route::get('index', 'IndexController@index')->name('index');
    Route::get('getSession', 'IndexController@getSession');
});

Route::get('everan/admin', 'Index\IndexController@admin')->middleware(['web', 'admin.login']);

