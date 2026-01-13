<?php

use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::apiResource('project', ProjectController::class);
});

Route::get('roles', function() {
    return ['roles' => App\Domains\Shared\Model\Role::first()];
});
