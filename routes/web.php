<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminFoundItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ItemRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FoundItemController::class, 'index'])->name('found-items.index');
Route::post('/itens-encontrados/{item}/solicitacoes', [ItemRequestController::class, 'store'])->name('item-requests.store');

Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('admin.login.store');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (): void {
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    Route::get('/conta', [AdminAccountController::class, 'edit'])->name('account.edit');
    Route::put('/conta', [AdminAccountController::class, 'update'])->name('account.update');
    Route::get('/itens', [AdminFoundItemController::class, 'index'])->name('found-items.index');
    Route::post('/itens', [AdminFoundItemController::class, 'store'])->name('found-items.store');
    Route::get('/itens/{item}/editar', [AdminFoundItemController::class, 'edit'])->name('found-items.edit');
    Route::put('/itens/{item}', [AdminFoundItemController::class, 'update'])->name('found-items.update');
    Route::delete('/itens/{item}', [AdminFoundItemController::class, 'destroy'])->name('found-items.destroy');
});
