<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index']);
Route::get('/usuarios/registrar', [UserController::class, 'create']);
Route::post('/usuarios/criar', [UserController::class, 'store']);
Route::delete('/usuarios/deletar/{id}', [UserController::class, 'destroy']);
Route::get('/usuarios/editar/{id}', [UserController::class, 'edit']);
Route::put('/usuarios/atualizar/{id}', [UserController::class, 'update']);
