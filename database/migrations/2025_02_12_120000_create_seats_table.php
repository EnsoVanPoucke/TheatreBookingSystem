<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('seats', function (Blueprint $table) {
			$table->date('screening_date');
			$table->time('screening_time');
			$table->unsignedTinyInteger('screen_number');
			$table->unsignedSmallInteger('global_seat_number');
			$table->unsignedTinyInteger('seat_number');
			$table->unsignedTinyInteger('row_number');
			$table->unsignedSmallInteger('seat_status');

			// Composite primary key
			$table->primary(['screening_date', 'screening_time', 'screen_number', 'global_seat_number']);

			// Foreign key referencing screenings table
			$table->foreign(['screening_date', 'screening_time', 'screen_number'])
				->references(['screening_date', 'screening_time', 'screen_number'])
				->on('screenings')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('seats');
	}
};
