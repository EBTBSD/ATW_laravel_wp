<?php


use App\Models\Log;
use Illuminate\Support\Facades\Route;


Route::get('/', \App\Livewire\Dashboard\StatusIndex::class)->name('home');

Route::post('/logs', [\App\Http\Controllers\LogController::class, 'store'])
    ->name('logs.store');

Route::post('/log/increment', [\App\Http\Controllers\LogController::class, 'incrementUpdateCount',])
    ->name('logs.increment');