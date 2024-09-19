<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/resumen', [InventoryController::class, 'resumen'])->name('resumen');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registrar', [InventoryController::class, 'registerView'])->name('registrar.view');
    
    Route::post('/registrar_elem', [InventoryController::class, 'registerStoreElem'])->name('registrar.storelem');

    Route::post('/registrar_adq', [InventoryController::class, 'registerStoreAdq'])->name('registrar.storeadq');

    

    Route::get('/componente/{id}/ver', [InventoryController::class, 'componentView'])->name('componente_ver');

    Route::delete('/compra/{id}', [InventoryController::class, 'compraDelete'])->name('compra_delete');
});

require __DIR__.'/auth.php';
