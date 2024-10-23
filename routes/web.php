<?php

use App\Http\Controllers\_SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/',_SiteController::class)->name('index');
