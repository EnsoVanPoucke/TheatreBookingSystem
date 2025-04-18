<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\MovieScheduleController;

Route::get('/', function () {
	return view('welcome');
});



// Route to render the page with the calendar
Route::get('admin/calendar', function () {
	return view('admin_calendar');
});

// Separate route to fetch events (use a prefix like api or ajax)
Route::get('/admin/calendar/events', [ScreeningController::class, 'getEvents']);
Route::post('/admin/calendar/create', [ScreeningController::class, 'store']);
Route::delete('/admin/calendar/delete', [ScreeningController::class, 'delete']);



Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', function () {
	session(['url.intended' => url()->previous()]);
	return view('auth.login');
})->name('login');

require __DIR__ . '/auth.php';

Route::get('/movies/details/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/Booking/TicketSelection/{data}', [BookingController::class, 'show'])->name('TicketSelection');
Route::get('/Booking/SeatSelection/{data}', [BookingController::class, 'showroom'])->name('SeatSelection');
Route::post('/booking/showroom', [BookingController::class, 'showroom'])->name('booking.showroom');
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
