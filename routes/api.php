<?php

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Employee;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


//----POSITIONS----//
//Get all positions
Route::get('/positions', function () {
    return response(Position::all());
});
//Add new position
Route::put('/position', 'PositionsController@add');
//Get position
Route::get('/position/{id}', 'PositionsController@get');
//Save position
Route::post('/position/{id}', 'PositionsController@save');
//Del position
Route::delete('/position/{id}', 'PositionsController@del');


//----EMPLOYEES----//
//Get all employees
Route::get('/employees', function () {
    return response(Employee::with('position:id,name')->get());
});
//Add new employee
Route::put('/employee', 'EmployeesController@add');
//Get employee
Route::get('/employee/{id}', 'EmployeesController@get');
//Save employee
Route::post('/employee/{id}', 'EmployeesController@save');
//Del employee
Route::delete('/employee/{id}', 'EmployeesController@del');
