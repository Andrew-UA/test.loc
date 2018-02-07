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
//HOME
Route::get('/', function () {
    return view('home');
});


//---POSITIONS---//
//Show all positions
Route::get('/positions', 'PositionsController@showAll')->name('positions');
//Add new position
Route::get('/position/add', 'PositionsController@addShowForm')->name('position_add');
//Edit position
Route::get('/position/{id}/edit', 'PositionsController@editShowForm')->name('positions_edit');

//---EMPLOYEES---//
//Show all employees
Route::get('/employees', 'EmployeesController@showAll')->name('employees');
//Add new employee
Route::get('/employee/add', 'EmployeesController@addShowForm')->name('employee_add');
//Edit employee
Route::get('/employee/{id}/edit', 'EmployeesController@editShowForm')->name('employee_edit');




