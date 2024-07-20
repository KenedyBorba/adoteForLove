<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\Auth\PasswordController;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('pets.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('pets.index');
})->middleware(['auth', 'verified'])->name('pets.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //pets
    Route::get('/my-pets',[PetController::class, 'myPets'])->name('pets.myPets');

    //enderecos
    Route::get('/estados', [ProfileController::class, 'getEstados'])->name('estados');
    Route::get('/cidades', [ProfileController::class, 'getCidades'])->name('cidades');

    Route::get('/racas', [PetController::class, 'getRacas'])->name('racas');

    Route::get('/chat', [MessagesController::class, 'index'])->name('chat');
    Route::get('/chatify/{id}', [MessagesController::class, 'index'])->name('chat.show');    

});

//enderecos
Route::get('/estados', [ProfileController::class, 'getEstados'])->name('estados');
Route::get('/cidades', [ProfileController::class, 'getCidades'])->name('cidades');

Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail']);
Route::get('/password/reset/{token}', [PasswordController::class, 'reset']);

Route::resource('pets', PetController::class);

require __DIR__.'/auth.php';
