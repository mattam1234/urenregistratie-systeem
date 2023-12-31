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

//auth
Route::get('/', function () {
    return view('Auth/login');
});
Auth::routes();

//recources

Route::resource('verlof', 'VerlofController');

//routes

Route::get('/home', 'HomeController@index')->name('home');

//verlof

Route::get('/verlof-status', 'VerlofController@index')->name('verlof');

//catagorie

Route::get('/categories','CategoryController@index')->name('category.index');
Route::get('/categories/create','CategoryController@create')->name('category.create');
Route::post('/categories/store','CategoryController@store')->name('category.store');
Route::get('/categories/{id}/edit','CategoryController@edit')->name('category.edit');
Route::post('/categories/{id}/update','CategoryController@update')->name('category.update');
Route::delete('/categories/{id}/delete','CategoryController@destroy')->name('category.delete');

//projects

Route::get('/projects/all','ProjectController@index')->name('project.all');
Route::get('/projects/ongoing','ProjectController@ongoing')->name('project.ongoing');
Route::get('/projects/finished','ProjectController@completed')->name('project.finished');
Route::get('/projects/create','ProjectController@create')->name('project.create');
Route::post('/projects/store','ProjectController@store')->name('project.store');
Route::get('/projects/{id}/edit','ProjectController@edit')->name('project.edit');
Route::post('/projects/{id}/update','ProjectController@update')->name('project.update');
Route::delete('/projects/{id}/delete','ProjectCont1roller@destroy')->name('project.delete');
Route::post('/projects/{id}/make_completed','ProjectController@makeCompleted')->name('project.make_completed');
Route::post('/projects/{id}/make_pending','ProjectController@makePending')->name('project.make_pending');

//porject tasks

Route::get('/project_tasks/all','ProjectTaskController@index')->name('project_task.all');
Route::get('/project_tasks/create','ProjectTaskController@create')->name('project_task.create');
Route::post('/project_tasks/store','ProjectTaskController@store')->name('project_task.store');
Route::get('/project_tasks/{id}/edit','ProjectTaskController@edit')->name('project_task.edit');
Route::post('/project_tasks/{id}/update','ProjectTaskController@update')->name('project_task.update');
Route::delete('/project_tasks/{id}/delete','ProjectTaskController@destroy')->name('project_task.delete');
Route::post('/project_tasks/{id}/make_completed','ProjectTaskController@makeCompleted')->name('project_task.make_completed');
Route::post('/project_tasks/{id}/make_pending','ProjectTaskController@makePending')->name('project_task.make_pending');
Route::get('/project_tasks/pending','ProjectTaskController@pendingProjectTasks')->name('project_task.pending');
Route::get('/project_tasks/finished','ProjectTaskController@finishedProjectTasks')->name('project_task.finished');

//tasks

Route::get('/tasks/ongoing','TaskController@index')->name('task.ongoing');
Route::get('/tasks/pending','TaskController@pending')->name('task.pending');
Route::get('/tasks/completed','TaskController@completed')->name('task.completed');
Route::get('/tasks/create','TaskController@create')->name('task.create');
Route::post('/tasks/store','TaskController@store')->name('task.store');
Route::get('/tasks/{id}/edit','TaskController@edit')->name('task.edit');
Route::post('/tasks/{id}/update','TaskController@update')->name('task.update');
Route::delete('/tasks/{id}/delete','TaskController@destroy')->name('task.delete');
Route::post('/tasks/{id}/completed','TaskController@makeCompleted')->name('task.make_completed');
Route::post('/tasks/{id}/pending','TaskController@makePending')->name('task.make_pending');


//factory
Route::get('/setup', function (){

   factory('App\Setup', 1) ->create();
   echo '1 user created';

});


Route::get('/add-users', function(){
    factory('App\User', 10) -> create();
    echo '10 users added';
});
