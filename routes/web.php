<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\VehiculoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');



/// RUTAS DE USUARIOS
Route::prefix('usuario')->group(function () {
    Route::get("/cliente-index", [ClienteController::class, "index"])->name('cliente.index')->middleware('auth');
    Route::get("/cliente-edit", [ClienteController::class, "edit"])->name('cliente.edit')->middleware('auth');
    Route::put("/cliente-update/{cliente}", [ClienteController::class, "update"])->name('cliente.update')->middleware('auth');
    Route::get("/cliente-create", [ClienteController::class, "create"])->name('cliente.create')->middleware('auth');
    Route::post("/cliente-store", [ClienteController::class, "store"])->name('cliente.store')->middleware('auth');
    Route::get("/cliente-delete/{id}", [ClienteController::class, "destroy"])->name('cliente.delete')->middleware('auth');
  

    Route::get("/conductor-index", [ConductorController::class, "index"])->name('conductor.index')->middleware('auth');
    Route::get("/conductor-edit", [ConductorController::class, "edit"])->name('conductor.edit')->middleware('auth');
    Route::put("/conductor-update/{conductor}", [ConductorController::class, "update"])->name('conductor.update')->middleware('auth');
    Route::get("/conductor-create", [ConductorController::class, "create"])->name('conductor.create')->middleware('auth');
    Route::post("/conductor-store", [ConductorController::class, "store"])->name('conductor.store')->middleware('auth');
    Route::get("/conductor-delete/{id}", [ConductorController::class, "destroy"])->name('conductor.delete')->middleware('auth');



    Route::get("/personal-index", [PersonalController::class, "index"])->name('personal.index')->middleware('auth');
    Route::get("/personal-edit", [personalController::class, "edit"])->name('personal.edit')->middleware('auth');
    Route::put("/personal-update/{personal}", [personalController::class, "update"])->name('personal.update')->middleware('auth');
    Route::get("/personal-create", [personalController::class, "create"])->name('personal.create')->middleware('auth');
    Route::post("/personal-store", [personalController::class, "store"])->name('personal.store')->middleware('auth');
    Route::get("/personal-delete/{id}", [personalController::class, "destroy"])->name('personal.delete')->middleware('auth');
  
    
});


Route::prefix('usuario')->group(function () {
    Route::get("/vehiculo-index", [VehiculoController::class, "index"])->name('vehiculo.index')->middleware('auth');
    Route::get("/vehiculo-edit", [VehiculoController::class, "edit"])->name('vehiculo.edit')->middleware('auth');
    Route::put("/vehiculo-update/{vehiculo}", [VehiculoController::class, "update"])->name('vehiculo.update')->middleware('auth');
    Route::get("/vehiculo-create", [VehiculoController::class, "create"])->name('vehiculo.create')->middleware('auth');
    Route::post("/vehiculo-store", [VehiculoController::class, "store"])->name('vehiculo.store')->middleware('auth');
    Route::get("/vehiculo-delete/{id}", [VehiculoController::class, "destroy"])->name('vehiculo.delete')->middleware('auth');
});
