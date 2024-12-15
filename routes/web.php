<?php

use App\Http\Controllers\AparelhoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Models\Aparelho;
use App\Models\Reserva;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth/login');
Route::view('/agendamentos', 'agendamentos')->name('agendamentos');
Route::view('/esq-senha', 'esq-senha')->name('esq-senha');
Route::view('/paginateste', 'paginateste')->name('paginateste');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ReservaController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/store', [ReservaController::class, 'store'])->name('reserva.store');

    Route::get('/relatorios/pagina1', action: [RelatorioController::class, 'pagina1'])->name('relatorios.pagina1');
Route::get('/relatorios/pagina2', action: [RelatorioController::class, 'pagina2'])->name('relatorios.pagina2');
Route::get('/relatorios/pagina3', action: [RelatorioController::class, 'pagina3'])->name('relatorios.pagina3');
Route::get('/relatorios/pagina4', action: [RelatorioController::class, 'pagina4'])->name('relatorios.pagina4');


    Route::match(['get', 'post'], '/aparelhos', AparelhoController::class)->name('aparelhos.index');
    Route::get('/aparelhos/create', [AparelhoController::class, 'create'])->name('aparelhos.create');
    Route::post('/aparelhos/store', [AparelhoController::class, 'store'])->name('aparelhos.store');
    Route::get('/aparelhos/{id}', [AparelhoController::class, 'show'])->name('aparelhos.show');
    Route::get('/aparelhos/{id}/edit', [AparelhoController::class, 'edit'])->name('aparelhos.edit');
    Route::put('/aparelhos/{id}', [AparelhoController::class, 'update'])->name('aparelhos.update');
    Route::delete('/aparelhos/{id}', [AparelhoController::class, 'destroy'])->name('aparelhos.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
