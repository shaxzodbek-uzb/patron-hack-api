<?php

use App\Http\Controllers\RoleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('roles', RoleController::class);
Route::resource('payment-types', 'PaymentTypeController');
Route::resource('organizational-structures', 'OrganizationalStructureController');
Route::resource('users', 'UserController');
Route::resource('employees', 'EmployeeController');
Route::resource('employee-positions', 'EmployeePositionController');