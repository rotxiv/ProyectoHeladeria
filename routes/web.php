<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;

Route::get('/', function () {
    return view('principal');
})->name('principal'); // pagina de inicio.

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'rol:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    Route::resource('clientes', ClienteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RolController::class);
});




/* Route::middleware(['auth', 'rol:Administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/', fn() => view('admin.dashboard'));

    Route::resource('clientes', ClienteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('roles', RolController::class);
}); */



/* Route::get('/camarero', function () {
    return view('camarero.dashboard');
})->middleware(['auth', 'rol:Camarero'])->name('camarero'); */




