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

/*Route::get('/', function () {
   $redis = app()->make('redis');
   $redis->set('key', 'shanta');
   dd($redis->get('key'));
});*/

/*Route::get('/', function () {
    // redis has students.all key exists
    // posts found then it will return all post without touching the database
    if ($students = \Illuminate\Support\Facades\Redis::get('StudentsModel.getAll')) {
        \Illuminate\Support\Facades\DB::connection()->enableQueryLog();
        print_r(\Illuminate\Support\Facades\DB::getQueryLog());
        return json_decode($students);
    }

    // get all students
    $students = \App\Models\StudentsModel::all();

    // store into redis
    \Illuminate\Support\Facades\Redis::set('StudentsModel.getAll', $students);

    // return all students
    return $students;
});*/

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
