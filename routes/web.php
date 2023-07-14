<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
//use Illuminate\Support\Facades\Request;
//use App\Models\Ticket;
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
Route::get('/', [Controller::class, 'index'])->name('opening');

//User(agent) auth
Route::get('user/', [UserAuthController::class, 'index'])->name('user.home')->middleware('auth:web');
Route::get('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'customLogin'])->name('user.custom_login');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::get('/registration', [UserAuthController::class, 'registration'])->name('user.register');
Route::post('/custom_registration', [UserAuthController::class, 'customRegistration'])->name('user.custom_registration');
    
//Client auth
Route::get('client/', [ClientAuthController::class, 'index'])->name('client.home')->middleware('auth:webclient');
Route::get('client/login', [ClientAuthController::class, 'login'])->name('client.login');
Route::post('client/login', [ClientAuthController::class, 'customLogin'])->name('client.custom_login');
Route::get('client/logout', [ClientAuthController::class, 'logout'])->name('client.logout');
Route::get('client/registration', [ClientAuthController::class, 'registration'])->name('client.register');
Route::post('client/custom_registration', [ClientAuthController::class, 'customRegistration'])->name('client.custom_registration');

    
//Route::get('/client-ticket', [TicketController::class, 'getTickets'])->name('client-ticket')->middleware('auth:webclient');
//Route::get('/create-ticket/{client}', [TicketController::class, 'sendTicket'])->name('create-ticket')->middleware('auth:webclient'); //client creates ticket

Route::middleware(['web'])->group(function () {
  
  Route::get('tickets/create', [TicketController::class, 'create']) ->name('tickets.create');//client creates ticket
  //Route::get('/assign-ticket/{ticket}', [TicketController::class, 'assignTicket'])->name('assign-ticket'); // user takes on ticket
  //Route::get('/release-ticket/{ticket}', [TicketController::class, 'releaseTicket'])->name('release-ticket'); // user releases ticket
  Route::resource('comments', 'App\Http\Controllers\CommentController')->only(['store', 'show', 'destroy'])->parameters(['comments' => 'param']); //view_comments, store_comments, delete_comments
  Route::resource('statuses', 'App\Http\Controllers\StatusController')->only(['store', 'edit'])->parameters(['statuses' => 'ticket']); // edit_status, store_status
  Route::resource('clients', 'App\Http\Controllers\ClientController')->except(['show', 'destroy', 'create', 'edit', 'update'])->parameters(['clients' => 'ticket']); //add client/store  view_clients/index
  Route::resource('users', 'App\Http\Controllers\UserController')->only(['index'])->middleware('auth:web');
  Route::resource('ticket-clients', 'App\Http\Controllers\TicketClientController')->only(['edit', 'update'])->parameters(['ticket-clients' => 'param']); //add client/store  view_clients/index
  Route::resource('ticket-users', 'App\Http\Controllers\TicketUserController')->only(['edit', 'update'])->parameters(['ticket-users' => 'ticket']); //add client/store  view_clients/index
  Route::get('notifications/index-unread', [NotificationController::class, 'indexUnread']) ->name('notifications.index-unread');
  Route::get('notifications/update', [NotificationController::class,'update'])->name('notifications.update'); //mark as read

  Route::resource('notifications', 'App\Http\Controllers\NotificationController')->only(['index', 'show'])->parameters(['notifications' => 'id']);
  Route::get('notifications/destroy/{id}', [NotificationController::class, 'destroy']) ->name('notifications.destroy');


  
});
Route::resource('ticket-clients', 'App\Http\Controllers\TicketClientController')->only([ 'show', 'create'])->parameters(['ticket-clients' => 'client'])->middleware('auth:webclient'); //add client/store  view_clients/index

Route::resource('tickets', 'App\Http\Controllers\TicketController')->except(['update', 'create', 'destroy' /*nije koristeno trenutno */])->parameters(['tickets' => 'param']); //namjestit middleware //storeTickets/store, My_tickets/show, All_Tickets/index,     dodat delete mozda i update pick ili tade ticket/drop_ticket


//Route::post('search', [TicketController::class, 'search'])->name('search');


//Route::get('/client-ticket/{client}', [TicketController::class, 'getTickets'])->name('client-ticket')->middleware('auth:webclient'); //ticket per client
//Route::get('tickets/create/{user}', [TicketController::class, 'create']) ->name('tickets.create')->middleware('auth:web');//client creates ticket





Route::post('/broadcasting/auth', function () {
  return Auth::user();
});


//Route::get('send', [NotifyController::class, 'send'])->name('send');
//Route::get('mail', function () {
//    $order = App\Order::find(1);
//    return (new App\Notifications\MailNotification($order))
//                ->toMail($order->user);
//});
//Route::get('/send', ClientAuthController::class, 'send')->name('client.send');
