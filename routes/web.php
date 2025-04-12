<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MovieScheduleController;
use Illuminate\Http\Request;
use App\Http\Controllers\SeatController;

use App\Http\Controllers\BannerController;
use App\Models\Banner;
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
});

require __DIR__ . '/auth.php';





Route::get('/login', function () {
	session(['url.intended' => url()->previous()]);
	return view('auth.login');
})->name('login');







Route::post('/booking/showroom', [BookingController::class, 'showroom'])->name('booking.showroom');


Route::get('/movies/details/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/Booking/TicketSelection/{data}', [BookingController::class, 'show'])->name('TicketSelection');
Route::get('/Booking/SeatSelection/{data}', [BookingController::class, 'showroom'])->name('SeatSelection');
Route::post('/schedule-movie', [MovieScheduleController::class, 'scheduleMovie'])->name('schedule.movie');
Route::post('/book-seats', [SeatController::class, 'bookSeats']);

Route::get('/movies', function () {
	return view('movies');
});





Route::get('/booking/confirmation', function (Request $request) {
	$bookingData = json_decode($request->query('data'), true);
	return view('confirmation', compact('bookingData'));
});





Route::get('/checkout', function (Request $request) {
	return view('checkout', [
		'selectedTickets' => $request->selectedTickets
	]);
})->name('checkout');

Route::get('admin/schedule-movie', function () {
	return view('admin_schedule_movie');
});



// Route::post('/booking/showroom/{data}', [BookingController::class, 'showroom'])->name('booking.showroom');
// Route::get('/Booking/SeatSelection/{data}', [BookingController::class, 'showroom'])->name('SeatSelection');
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Route::get('/booking/confirmation', function () {
// 	return view('confirmation');
// });


// OR book data in session...
// Route::get('/booking/confirmation', function (Request $request) {
// 	$bookingData = session('bookingData');
// 	return view('confirmation', compact('bookingData'));
// });

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */






// Route::get('/', function () {
// 	return view('home');
// });





// Route::post('/send-message', function (Request $request) {
//     broadcast(new MessageSent($request->message));
//     return response()->json(['status' => 'Message sent!']);
// });




// Route::get('/movies', function () {
// 	return view('movies', compact('banners'));
// });


// Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
// Route::get('/movies/allefilms', [MovieController::class, 'index'])->name('movies.allefilms');
// Route::get('/movies/vandaag', [MovieController::class, 'today'])->name('movies.today');
// Route::get('/movies/morgen', [MovieController::class, 'tomorrow'])->name('movies.tomorrow');
