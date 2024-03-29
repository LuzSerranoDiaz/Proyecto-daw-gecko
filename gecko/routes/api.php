<?php

use App\Http\Controllers\ApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['middleware' => ['web']], function () {
    //rutas task
    Route::post('/store_task', [ApiController::class, 'store_task']);
    Route::put('/update_task/{id}', [ApiController::class, 'edit_task']);
    Route::delete('/delete_task/{id}', [ApiController::class, 'delete_task']);
    Route::get('/solve_task/{id}', [ApiController::class, 'solve_task']);
    //rutas comment
    Route::post('/store_comment', [ApiController::class, 'store_comment']);
    Route::delete('/delete_comment/{id}', [ApiController::class, 'delete_comment']);
});