<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UnitOfGoodController;
use App\Http\Controllers\api\GoodController;

Route::prefix('v1')->group(function () {
    Route::prefix('/goods')->group(function () {
        Route::post('/unit-of-goods', [UnitOfGoodController::class, 'store']);
        Route::get('/unit-of-goods', [UnitOfGoodController::class, 'show']);
        Route::patch('/unit-of-goods/{id}', [UnitOfGoodController::class, 'update'])->whereNumber('id');
        Route::delete('/unit-of-goods/{id}', [UnitOfGoodController::class, 'destroy'])->whereNumber('id');
    });

    Route::resource('goods', GoodController::class);

});




