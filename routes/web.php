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
use App\Http\Controllers\NotifyController;
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

    
Route::get('/client_ticket/{client}', [TicketController::class, 'getTicket'])->name('client_ticket')->middleware('auth:webclient'); //ticket per client

Route::get('/create_ticket/{client}', [TicketController::class, 'createTicket'])->name('create_ticket'); //client creates ticket
Route::get('/create_ticket_user/{user}', [TicketController::class, 'createTicketUser']) ->name('create_ticket_user')->middleware('auth:web');//client creates ticket
Route::get('/take_ticket/{id}', [TicketController::class, 'takeTicket'])->name('take_ticket')->middleware('auth:web'); // user takes on ticket
Route::get('/drop_ticket/{ticket}', [TicketController::class, 'dropTicket'])->name('drop_ticket')->middleware('auth:web'); // user releases ticket
Route::resource('tickets', 'App\Http\Controllers\TicketController')->except(['update','edit',  'create', 'destroy' /*nije koristeno trenutno */])->parameters(['tickets' => 'user']); //namjestit middleware //storeTickets/store, My_tickets/show, All_Tickets/index,     dodat delete mozda i update pick ili tade ticket/drop_ticket

Route::resource('users', 'App\Http\Controllers\UserController')->except(['show', 'destroy', 'create'])->parameters(['users' => 'ticket'])->middleware('auth:web');

Route::resource('comments', 'App\Http\Controllers\CommentController')->only(['store', 'show', 'destroy'])->parameters(['comments' => 'param'])->middleware('auth:web'); //view_comments, store_comments, delete_comments

Route::resource('statuses', 'App\Http\Controllers\StatusController')->only(['store', 'edit'])->parameters(['statuses' => 'param'])->middleware('auth:web'); // edit_status, store_status

Route::resource('clients', 'App\Http\Controllers\ClientController')->except(['show', 'destroy', 'create'])->parameters(['clients' => 'ticket'])->middleware('auth:web'); //add client/store  view_clients/index

//Route::any('/search',function(){
  //  $q = Request::get ( 'q' );
    
    //$new_client_id = $request->input('new_client_id')
  //  $ticket = Ticket::where('tic_name','LIKE','%'.$q.'%')->get(); //->orWhere('client','LIKE','%'.$q.'%')
  //  if(count($ticket) > 0)
  //      return view('all_tickets')->withDetails($ticket)->withQuery ( $q );
  //  else return view ('all_tickets')->withMessage('No Details found. Try to search again !');
//});
Route::post('search', [TicketController::class, 'search'])->name('search');










//Route::get('send', [NotifyController::class, 'send'])->name('send');
//Route::get('mail', function () {
//    $order = App\Order::find(1);
//    return (new App\Notifications\MailNotification($order))
//                ->toMail($order->user);
//});
//Route::get('/send', ClientAuthController::class, 'send')->name('client.send');
