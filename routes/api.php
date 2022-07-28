<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::controller(ResourceController::class)->group(function () {
    Route::resource('resources', ResourceController::class)->except(['create', 'show']);
    Route::get('resources/{resource}/download', 'download');
});
