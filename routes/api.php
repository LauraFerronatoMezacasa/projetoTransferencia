<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\TransferController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => ['api']], function () {
    Route::get('cadastro', [UserController::class, 'cadastro'])->name("usuario.cadastro");
    Route::post('cadastrar', [UserController::class, 'store'])->name("usuario.cadastrar");
    Route::get('inicio', [AuthController::class, 'inicio'])->name("usuario.inicio");
    Route::post("login", [AuthController::class,'login'])->name("usuario.login");
});

    Route::get('welcome', [HomeController::class, 'welcome'])->middleware('auth:sanctum')->name('usuario.welcome');
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('usuario.logout');
    Route::get('transferencias', [TransferController::class, 'transferencias'])->middleware('auth:sanctum')->name('usuario.transferencias');
    Route::post("transferir", [TransferController::class,'store'])->middleware('auth:sanctum')->name("usuario.transferir");
