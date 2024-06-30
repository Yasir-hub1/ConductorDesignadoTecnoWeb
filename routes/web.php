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
use App\Http\Controllers\GastoOperativoController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SolicitarServicioController;
use App\Http\Controllers\TransaccionesController;
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





   //TODO: MODULO DE VEHICULOS
    Route::get("/vehiculo-index", [VehiculoController::class, "index"])->name('vehiculo.index')->middleware('auth');
    Route::get("/vehiculo-edit", [VehiculoController::class, "edit"])->name('vehiculo.edit')->middleware('auth');
    Route::put("/vehiculo-update/{vehiculo}", [VehiculoController::class, "update"])->name('vehiculo.update')->middleware('auth');
    Route::get("/vehiculo-create", [VehiculoController::class, "create"])->name('vehiculo.create')->middleware('auth');
    Route::post("/vehiculo-store", [VehiculoController::class, "store"])->name('vehiculo.store')->middleware('auth');
    Route::get("/vehiculo-delete/{id}", [VehiculoController::class, "destroy"])->name('vehiculo.delete')->middleware('auth');





   //TODO: MODULO DE SERVICIOS
   Route::get("/servicio-index", [ServicioController::class, "index"])->name('servicio.index')->middleware('auth');
   Route::get("/servicio-edit", [ServicioController::class, "edit"])->name('servicio.edit')->middleware('auth');
   Route::put("/servicio-update/{servicio}", [ServicioController::class, "update"])->name('servicio.update')->middleware('auth');
   Route::get("/servicio-create", [ServicioController::class, "create"])->name('servicio.create')->middleware('auth');
   Route::post("/servicio-store", [ServicioController::class, "store"])->name('servicio.store')->middleware('auth');
   Route::get("/servicio-delete/{id}", [ServicioController::class, "destroy"])->name('servicio.delete')->middleware('auth');


   //TODO: MODULO DE SERVICIOS
   Route::get("/promocion-index", [PromocionController::class, "index"])->name('promocion.index')->middleware('auth');
   Route::get("/promocion-edit", [PromocionController::class, "edit"])->name('promocion.edit')->middleware('auth');
   Route::put("/promocion-update/{promocion}", [PromocionController::class, "update"])->name('promocion.update')->middleware('auth');
   Route::get("/promocion-create", [PromocionController::class, "create"])->name('promocion.create')->middleware('auth');
   Route::post("/promocion-store", [PromocionController::class, "store"])->name('promocion.store')->middleware('auth');
   Route::get("/promocion-delete/{id}", [PromocionController::class, "destroy"])->name('promocion.delete')->middleware('auth');


   //TODO: MODULO DE SERVICIOS
   Route::get("/reserva-index", [SolicitarServicioController::class, "index"])->name('reserva.index')->middleware('auth');
   Route::get("/reserva-edit", [SolicitarServicioController::class, "edit"])->name('reserva.edit')->middleware('auth');
   Route::put("/reserva-update/{reserva}", [SolicitarServicioController::class, "update"])->name('reserva.update')->middleware('auth');
   Route::get("/reserva-create", [SolicitarServicioController::class, "create"])->name('reserva.create')->middleware('auth');
   Route::post("/reserva-store", [SolicitarServicioController::class, "store"])->name('reserva.store')->middleware('auth');
   Route::get("/reserva-delete/{id}", [SolicitarServicioController::class, "destroy"])->name('reserva.delete')->middleware('auth');



      //TODO: MODULO DE GASTOS OPERATIVOS
      Route::get("/gasto-index", [GastoOperativoController::class, "index"])->name('gasto.index')->middleware('auth');
      Route::get("/gasto-edit", [GastoOperativoController::class, "edit"])->name('gasto.edit')->middleware('auth');
      Route::put("/gasto-update/{gasto}", [GastoOperativoController::class, "update"])->name('gasto.update')->middleware('auth');
      Route::get("/gasto-create", [GastoOperativoController::class, "create"])->name('gasto.create')->middleware('auth');
      Route::post("/gasto-store", [GastoOperativoController::class, "store"])->name('gasto.store')->middleware('auth');
      Route::get("/gasto-delete/{id}", [GastoOperativoController::class, "destroy"])->name('gasto.delete')->middleware('auth');






      //TODO: VIEW CLIENTE LOGUEADO
      Route::get("/cliente-login", [ClienteController::class, "login"])->name('cliente.login');
      Route::post('/cliente-auth', [LoginController::class, 'inicioSessionCliente'])->name('cliente-auth');
      Route::get("/cliente-inicio", [ClienteController::class, "inicio"])->name('cliente.inicio');

      Route::get("/cliente-pago-reserva", [ClienteController::class, "pagoReserva"])->name('cliente.pagoReserva');/// vista para realizar el pago
      Route::post("/cliente-guardarPagoDeReserva", [TransaccionesController::class, "guardarPagoDeReserva"])->name('cliente.guardarPagoDeReserva');/// vista para realizar el pago
      Route::get("/cliente-showPago", [TransaccionesController::class, "showPago"])->name('cliente.showPago');// visualiza el detalle del pago





      //TODO: VIEW CONDUCTOR LOGUEADO
      Route::get("/conductor-login", [ConductorController::class, "login"])->name('conductor.login');
      Route::post('/conductor-auth', [LoginController::class, 'inicioSessionconductor'])->name('conductor-auth');
      Route::get("/conductor-inicio", [ConductorController::class, "inicio"])->name('conductor.inicio');




        //TODO: REPORTE Y ESTADISTICA

 Route::get("/reporte-inicio", [TransaccionesController::class, "reportes"])->name('reporte.inicio');
//  Route::get("/reporte-inicio", [TransaccionesController::class, "reporteOperativo"])->name('reporte.inicio');
