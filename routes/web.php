<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketController2;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [Controller::class, 'index'])
    ->name('opening');

//User(agent) auth
Route::get('user/', [UserAuthController::class, 'index'])->name('user.home')->middleware('auth:web');
Route::get('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'customLogin'])->name('user.customLogin');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::get('/registration', [UserAuthController::class, 'registration'])->name('user.register');
Route::post('/customRegistration', [UserAuthController::class, 'customRegistration'])->name('user.customRegistration');
    
//Client auth
Route::get('client/', [ClientAuthController::class, 'index'])->name('client.home')->middleware('auth:webclient');
Route::get('client/login', [ClientAuthController::class, 'login'])->name('client.login');
Route::post('client/login', [ClientAuthController::class, 'customLogin'])->name('client.customLogin');
Route::get('client/logout', [ClientAuthController::class, 'logout'])->name('client.logout');
    // provjerit radi li registracija -> radi -> osigurat
Route::get('client/registration', [ClientAuthController::class, 'registration'])
    ->name('client.register');
Route::post('client/customRegistration', [ClientAuthController::class, 'customRegistration'])
    ->name('client.customRegistration');

    // Ticket and ticket creation ----> add deletion   Ticket and Client
Route::get('/client_ticket/{id}', [ClientAuthController::class, 'getTicket']) ->name('client_ticket')->middleware('auth:webclient'); //ticket per client
Route::get('/create_ticket/{id}', [TicketController::class, 'createTicket']) ->name('create_ticket'); //client creates ticket

//odabir klijenta za ticket napravljen od strane usera
Route::get('/create_ticket_user/{id}', [TicketController::class, 'createTicketUser']) ->name('create_ticket_user')->middleware('auth:web');//client creates ticket

//storeTickets/store, My_tickets/show, All_Tickets/index,     dodat delete mozda i update pick ili tade ticket/drop_ticket
Route::resource('tickets', 'App\Http\Controllers\TicketController')->except(['update','edit',  'create', 'destroy' /*nije koristeno trenutno */]); //namjestit middleware

Route::resource('users', 'App\Http\Controllers\UserController')->except(['show', 'destroy', 'create'])->middleware('auth:web');

// Ticket and User
Route::get('/take_ticket/{id}', [TicketController::class, 'takeTicket']) ->name('take_ticket')->middleware('auth:web'); // user takes on ticket
Route::get('/drop_ticket/{id}', [TicketController::class, 'dropTicket']) ->name('drop_ticket')->middleware('auth:web'); // user drops ticket

//comments
//view_comments, store_comments
Route::resource('comments', 'App\Http\Controllers\CommentController')->only(['store', 'show', 'destroy'])->middleware('auth:web');

// edit_status, store_status
Route::resource('statuses', 'App\Http\Controllers\StatusController')->only(['store', 'edit'])->middleware('auth:web');

//add client/store  view_clients/index
Route::resource('clients', 'App\Http\Controllers\ClientController')->except(['show', 'destroy', 'create'])->middleware('auth:web');




//Route::get('/all_tickets', [TicketController::class, 'all_tickets']) ->name('all_tickets')->middleware('auth:web'); // show all tickets  ->>>ZAMiJENJENO S resource tickets.index
//Route::post('/store_ticket', [TicketController::class, 'storeTicket']) ->name('store_ticket'); // store created ticket///////////////////////////////////////////////Zamijenjeno s resource ticket.store
//Route::get('/my_tickets/{id}', [UserAuthController::class, 'myTickets'])->name("user.my_tickets")->middleware('auth:web'); // show ticket user took on zamijenjeno s resource tickets.show

//Route::get('/view_comments/{id}', [CommentController::class, 'viewComments']) ->name('view_comments')->middleware('auth:web'); ////// resource show
//Route::post('/store_comment', [CommentController::class, 'storeComment']) ->name('store_comment')->middleware('auth:web'); ////// store

 //Route::get('/edit_status/{id}', [StatusController::class, 'editStatus']) ->name('edit_status')->middleware('auth:web'); //edit
//Route::post('/store_status', [StatusController::class, 'storeStatus']) ->name('store_status')->middleware('auth:web');  //store

//Route::get('/create_comment/{id}', [CommentController::class, 'createComment']) ->name('create_comment')->middleware('auth:web');


//Route::post('add_client', [ClientAuthController::class, 'addClient'])->name('add_client')->middleware('auth:web');
//Route::get('/view_clients', [ClientAuthController::class, 'viewClient']) ->name('user.view_clients'); 


//Route::post('/update_pick', [TicketController::class, 'updatePick']) ->name('update_pick')->middleware('auth:web'); //clients.update
//Route::get('/pick_client/{id}', [TicketController::class, 'pickClient']) ->name('pick_client')->middleware('auth:web'); //clients.edit

//Route::get('/pick_user/{id}', [TicketController::class, 'pickUser']) ->name('pick_user')->middleware('auth:web'); //users.edit
//Route::post('/update_user', [TicketController::class, 'updateUser']) ->name('update_user')->middleware('auth:web');  //users.update
//Route::get('/view_userss', [UserAuthController::class, 'viewUser']) ->name('user.view_users'); //users.index

//Route::get('/delete_comment/{id}', [CommentController::class, 'deleteComment']) ->name('delete_comment')->middleware('auth:web');
//Route::get('/delete_ticket/{id}', [TicketController::class, 'deleteTicket']) ->name('delete_ticket'); // delete ticket after status -> closed //ticket.destroy nije koristeno trenutno
