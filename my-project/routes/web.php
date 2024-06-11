<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PaisEstadoCidadeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return redirect()->route('pets.index');
})->middleware(['auth', 'verified'])->name('pets.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //pets
    Route::resource('pets', PetController::class);
    Route::get('/my-pets',[PetController::class, 'myPets'])->name('pets.myPets');

    //enderecos
    Route::get('/estados', [ProfileController::class, 'getEstados'])->name('estados');
    Route::get('/cidades', [ProfileController::class, 'getCidades'])->name('cidades');

    Route::get('/racas', [PetController::class, 'getRacas'])->name('racas');
});

require __DIR__.'/auth.php';
