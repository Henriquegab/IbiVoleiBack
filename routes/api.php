<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index']);
Route::apiResource('/grupos', GrupoController::class)->except(['show']);
Route::apiResource('/grupos', GrupoController::class)->except(['show']);

Route::get('/usuario_grupos/{id}', [GrupoController::class, 'usuario_grupos']);
Route::get('/grupos/{id}', [GrupoController::class, 'show']);



Route::resource('agendamento',AgendamentoController::class);

Route::middleware('auth.jwt')->group(
    function(){



        // Usuários


        Route::post('/logout', [UserController::class, 'logout']);





    });
