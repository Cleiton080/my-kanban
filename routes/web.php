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

Auth::routes();

Route::get('/', 'ProjectController@index');
Route::post('/project/add', 'ProjectController@create')->name('project.create');
Route::delete('/project/delete', 'ProjectController@delete')->name('project.delete');
Route::get('/project/{id}', 'ProjectController@project')->name('project.board');

Route::post('/project/stage/add', 'StageController@create')->name('stage.create');
Route::delete('/project/stage/delete', 'StageController@delete')->name('stage.delete');
Route::get('/project/stage/{id}', 'StageController@stage');
Route::put('/project/stage/update', 'StageController@update')->name('stage.update');

Route::post('/project/task/add', 'TaskController@create')->name('task.create');
Route::put('/project/task/update', 'TaskController@update');

Route::get('/favorite', 'FavoriteController@index');
Route::put('/favorite/update', 'ProjectController@favorite')->name('project.favorite');