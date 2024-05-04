<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PaisEstadoCidadeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //pets
    Route::resource('pets', PetController::class);
    // Route::get('/listar-pets', [PetController::class, 'list'])->name('pets.list');
    // Route::get('/editar-pet/{id}', [PetController::class, 'edit'])->name('pets.edit');
    // Route::get('/visualizar-pet/{id}', [PetController::class, 'show'])->name('pets.show');
    // Route::get('/visualizar-pet/{id}', [PetController::class, 'update'])->name('pets.update');
    // Route::get('/cadastrar-pet', [PetController::class, 'create']);
    // Route::post('/cadastrar-pet', [PetController::class, 'store'])->name('pets.create');

    //enderecos
    Route::get('/estados', [ProfileController::class, 'getEstados'])->name('estados');
    Route::get('/cidades', [ProfileController::class, 'getCidades'])->name('cidades');
});

require __DIR__.'/auth.php';
