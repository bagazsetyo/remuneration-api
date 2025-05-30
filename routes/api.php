<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\API\EmployeeController::class)
    ->prefix('employee')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/all', 'allEmployees');
        Route::post('/', 'store');
        Route::put('/{employee}', 'update');
        Route::delete('/{employee}', 'destroy');
        Route::get('/{employee}', 'show');
    });


Route::controller(\App\Http\Controllers\API\ProjectController::class)
    ->prefix('project')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{project}', 'update');
        Route::get('/{project}', 'show');
        Route::delete('/{project}', 'destroy');
    })->middleware(\App\Http\Middleware\Cors::class);

Route::controller(\App\Http\Controllers\API\ContributionController::class)
    ->prefix('contribution')
    ->group(function () {
        Route::post('/', 'store');
        Route::put('/{contribution}', 'update');
        Route::get('/{contribution}', 'show');
        Route::delete('/{contribution}', 'destroy');
    });
