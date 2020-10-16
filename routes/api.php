<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/companies', 'CompanyController@index');
Route::get('/company/{id}', 'CompanyController@show');
Route::post('/company', 'CompanyController@store');
Route::put('/company', 'CompanyController@store');
Route::delete('/company/{id}', 'CompanyController@destroy');

Route::get('/departments', 'DepartmentController@index');
Route::get('/department/{id}', 'DepartmentController@show');
Route::post('/department', 'DepartmentController@store');
Route::put('/department', 'DepartmentController@store');
Route::delete('/department/{id}', 'DepartmentController@destroy');

Route::get('/employees', 'EmployeeController@index');
Route::get('/employee/{id}', 'EmployeeController@show');
Route::post('/employee', 'EmployeeController@store');
Route::put('/employee', 'EmployeeController@store');
Route::delete('/employee/{id}', 'EmployeeController@destroy');
