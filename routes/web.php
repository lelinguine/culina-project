<?php

use Illuminate\Support\Facades\Route;

// VueJS
use App\Http\Controllers\Web\AppController;

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');