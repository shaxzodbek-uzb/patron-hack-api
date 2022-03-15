<?php

use App\Http\Controllers\BusinessProcessController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ClassificationGroupController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePositionController;
use App\Http\Controllers\OrganizationalStructureController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\UserController;
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
Route::resource('rules', RuleController::class);
Route::resource('payment-types', PaymentTypeController::class);
Route::resource('organizational-structures', OrganizationalStructureController::class);
Route::resource('users', UserController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('employee-positions', EmployeePositionController::class);

Route::post('business-processes/complete-classification', [BusinessProcessController::class, 'completeClassification']);
Route::resource('business-processes', BusinessProcessController::class);
Route::resource('classifications', ClassificationController::class);
Route::resource('classification-groups', ClassificationGroupController::class);