<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\TicketController;

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
    return view('welcome');
});

//User(agent) auth
Route::get('user/', [UserAuthController::class, 'index'])
    ->name('user.home');
    //->middleware('auth:web');
Route::get('/login', [UserAuthController::class, 'login'])
    ->name('user.login');
Route::post('/login', [UserAuthController::class, 'customLogin'])
    ->name('user.customLogin');
Route::get('/logout', [UserAuthController::class, 'logout'])
    ->name('user.logout');
Route::get('/registration', [UserAuthController::class, 'registration'])
    ->name('user.register');
Route::post('/customRegistration', [UserAuthController::class, 'customRegistration'])
    ->name('user.customRegistration');

//Client auth
Route::get('client/', [ClientAuthController::class, 'index'])
    ->name('client.home')
    ->middleware('auth:webclient');
Route::get('client/login', [ClientAuthController::class, 'login'])
    ->name('client.login');
Route::post('client/login', [ClientAuthController::class, 'customLogin'])
    ->name('client.customLogin');
Route::get('client/logout', [ClientAuthController::class, 'logout'])
    ->name('client.logout');

    // provjerit radi li registracija
Route::get('client/registration', [ClientAuthController::class, 'registration'])
    ->name('client.register');
Route::post('client/customRegistration', [ClientAuthController::class, 'customRegistration'])
    ->name('client.customRegistration');


Route::get('/client_ticket/{id}', [ClientAuthController::class, 'getTicket']) ->name('client_ticket'); //ticket per client
Route::get('/create_ticket/{id}', [ClientAuthController::class, 'createTicket']) ->name('create_ticket'); //client creates ticket
Route::post('/store_ticket', [TicketController::class, 'storeTicket']) ->name('store_ticket'); // store created ticket

Route::get('/all_tickets', [TicketController::class, 'all_tickets']) ->name('all_tickets'); // show all tickets  ->>>turn into show all AVAILABLE
Route::get('/take_ticket/{id}', [TicketController::class, 'takeTicket']) ->name('take_ticket');
Route::get('/my_tickets/{id}', [UserAuthController::class, 'myTickets'])->name("user.my_tickets");