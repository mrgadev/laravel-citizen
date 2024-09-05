<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
Route::middleware('warga')->prefix('/callback')->name('callback.')->group(function () {
    Route::view('/return', 'callback.return')->name('return');
    Route::view('/cancel', 'callback.cancel')->name('cancel');
    Route::get('/notify', [PaymentController::class, 'notify'])->name('notify');
    
});