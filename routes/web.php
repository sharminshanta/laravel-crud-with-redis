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

/**
 * Default route
 * Actually all members list page is displayed here
 */
Route::get('/', 'MemberController@index');

/**
 * Members Routes
 * All members related routes like - member's add, list, update, delete actions here
 */
Route::group(['prefix' => 'members'], function () {
    Route::get('/', 'MemberController@index'); //Member's list page
    Route::get('/add', 'MemberController@create'); //Member's Add page
    Route::post('/store', 'MemberController@store'); //Member's Add page
    Route::get('/edit/{id}', 'MemberController@edit'); //Member's Update page
    Route::post('/update', 'MemberController@update'); //Member's Update page
    Route::post('/delete', 'MemberController@destroy'); //Member's Delete page
});
