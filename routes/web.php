<?php

use App\Http\Controllers\AdminFoundItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ItemRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FoundItemController::class, 'index'])->name('found-items.index');
Route::post('/itens-encontrados/{item}/solicitacoes', [ItemRequestController::class, 'store'])->name('item-requests.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/itens', [AdminFoundItemController::class, 'index'])->name('found-items.index');
    Route::post('/itens', [AdminFoundItemController::class, 'store'])->name('found-items.store');
    Route::get('/itens/{item}/editar', [AdminFoundItemController::class, 'edit'])->name('found-items.edit');
    Route::put('/itens/{item}', [AdminFoundItemController::class, 'update'])->name('found-items.update');
    Route::delete('/itens/{item}', [AdminFoundItemController::class, 'destroy'])->name('found-items.destroy');
});
