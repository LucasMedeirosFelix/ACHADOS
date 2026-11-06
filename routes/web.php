<?php

use App\Http\Controllers\FoundItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FoundItemController::class, 'index'])->name('found-items.index');
Route::post('/itens-encontrados', [FoundItemController::class, 'store'])->name('found-items.store');
Route::delete('/itens-encontrados/{item}', [FoundItemController::class, 'destroy'])->name('found-items.destroy');
