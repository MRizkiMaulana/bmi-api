<?php

use App\Http\Controllers\API\BmiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/bmi', [BmiController::class, 'masukdata']);
Route::get('/bmi', [BmiController::class, 'liatdata']);
Route::get('/bmi/{bmiId}', [BmiController::class, 'lihatdataid']);
Route::put('/bmi/{bmiId}', [BmiController::class, 'update']);
