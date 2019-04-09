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

//populate books table and authors table with csv information
Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::post('books/{book}/subscribe', 'BookController@subscribe');
// Route::post('books/{book}/unsubscribe', 'BookController@unsubscribe');

Route::resource('books', 'BookController');
Route::resource('authors', 'AuthorController');

Route::resource('projects', 'ProjectController');
Route::resource('departments', 'DepartmentController');
Route::resource('timesheets', 'TimesheetController');
Route::resource('shifts', 'ShiftController');
Route::resource('users', 'UserController');

Route::resource('suppliers', 'SupplierController');
Route::resource('equipment', 'EquipmentController');

Route::get('equipment/rent/{id}', 'EquipmentController@rent');
Route::get('equipment/return/{id}', 'EquipmentController@return');


// Route::resource('comments', 'CommentController');
