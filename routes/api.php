<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\BillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestController;

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

Route::post('/v1/project/add', [ProjectController::class, 'add']);
Route::post('/v1/project/update', [ProjectController::class, 'update']);
Route::get('/v1/project/{id}', [ProjectController::class, 'item']);
Route::get('/v1/project/{id}/delete', [ProjectController::class, 'delete']);
Route::get('/v1/project/list', [ProjectController::class, 'list']);
Route::get('/v1/project/{id}/bills', [BillController::class, 'listByProject']);
Route::get('/v1/project/{id}/requests', [RequestController::class, 'listByProject']);

Route::post('/v1/bill/add', [BillController::class, 'add']);
Route::post('/v1/bill/update', [BillController::class, 'update']);
Route::get('/v1/bill/{id}', [BillController::class, 'item']);
Route::get('/v1/bill/{id}/delete', [BillController::class, 'delete']);
Route::get('/v1/bill/list', [BillController::class, 'list']);
Route::get('/v1/bill/{id}/payments', [BillController::class, 'payments']);

Route::post('/v1/request/add', [RequestController::class, 'add']);
Route::post('/v1/request/update', [RequestController::class, 'update']);
Route::get('/v1/request/{id}', [RequestController::class, 'item']);
Route::get('/v1/request/{id}/delete', [RequestController::class, 'delete']);
Route::get('/v1/request/list', [RequestController::class, 'list']);
Route::get('/v1/request/{id}/bills', [BillController::class, 'listByRequest']);

Route::get('/v1/info', [InfoController::class, 'list']);

Route::post('/v1/bill/add', [BillController::class, 'add']);
Route::post('/v1/bill/update', [BillController::class, 'update']);
Route::get('/v1/bill/{id}', [BillController::class, 'item']);
Route::get('/v1/bill/{id}/delete', [BillController::class, 'delete']);
