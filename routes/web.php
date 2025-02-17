<?php

use App\Models\Seats;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieScheduleController;
use App\Http\Controllers\TesterController;
// use App\Http\Controllers\ScreenroomController;







Route::get('/', function () {
	return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/showtime/{id}', [ShowtimeController::class, 'show'])->name('showtime.details');


// Route om de schermweergave te tonen
Route::get('/screenroom', function () {

	$booking = Session::get('booking'); // get the booking session variable
	if (!$booking) {
		return redirect()->route('home')->with('error', 'Geen boekingsinformatie gevonden.');
	}

	$date = $booking['selection-date'];
	$time = $booking['selection-time'];
	$screenroom = $booking['selection-screenroom'];

	$roomGridBlueprint = Config::get("gridblueprints.blueprints")[$screenroom] ?? null;
	if (!$roomGridBlueprint) {
		return redirect()->route('home')->with('error', 'Geen grid blueprint gevonden voor deze zaal.');
	}

	// instead retrieve all rows from the seats table WHERE primary key = date, time, screenroom, seatnumber
	$roomData = Seats::where('show_date', $date)
		->where('show_time', $time)
		->where('screenroom_number', $screenroom)
		->get();

	$globalSeatNumber = 0;
	$seatNumber = 0;

	foreach ($roomGridBlueprint as $rowIndex => $row) {
		foreach ($row as $colIndex => $seat) {
			if ($seat === 1 || $seat === 1001) {

				$globalSeatNumber++;

				if ($roomGridBlueprint[$rowIndex][$colIndex] !== $roomData[$globalSeatNumber - 1]["seat_status"]) {
					$roomGridBlueprint[$rowIndex][$colIndex] = $roomData[$globalSeatNumber - 1]["seat_status"];
				}
			}
		}
	}
	return view('screenroom', compact('booking', 'roomGridBlueprint'));
})->name('screenroom');



// print('<pre>');
// print_r($roomGridBlueprint);
// print('</pre>');
// exit;



// Route::get('/screenroom', [ScreenroomController::class, 'index']);

Route::post('/screenroom', function (Request $request) {
	// Gegevens opslaan in de sessie
	Session::put('booking', [
		'single-normaal' => $request->input('single-normaal'),
		'single-korting' => $request->input('single-korting'),
		'duo-normaal' => $request->input('duo-normaal'),
		'duo-korting' => $request->input('duo-korting'),
		'total-price' => $request->input('total-price'),

		// Filmgegevens
		'selection-title' => $request->input('selection-title'),
		'selection-screenroom' => $request->input('selection-screenroom'),
		'selection-date' => $request->input('selection-date'),
		'selection-time' => $request->input('selection-time'),
		'selection-movieposter' => $request->input('selection-movieposter')
	]);

	return redirect()->route('screenroom');
})->name('screenroom.store');

Route::get('/tester', function () {
	return view('tester');
});

Route::post('/tester', [TesterController::class, 'store']);



Route::get('admin/schedule', function () {
	return view('admin_schedule_movie');
});


Route::post('/schedule-movie', [MovieScheduleController::class, 'scheduleMovie'])->name('schedule.movie');



// use App\Models\BookedSeat;

// Route::get('/booked-seats', function () {
//     $bookedSeats = BookedSeat::all(); // Or filter by a room ID, depending on your needs.
//     return response()->json($bookedSeats);
// });