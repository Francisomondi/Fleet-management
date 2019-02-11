<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration {

	public function up() {
		Schema::create('bookings', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_id');
			$table->integer('user_id');
			$table->integer('vehicle_id');
			$table->string('pickup_time');
			$table->string('pickup_addr');
			$table->string('dest_addr');
			$table->integer('travellers')->default(1);
			$table->date('from_date');
			$table->date('to_date');
			$table->integer('status')->default(0);
			$table->nullableTimestamps();
			$table->softDeletes();

		});
	}

	public function down() {
		Schema::dropIfExists("bookings");
	}
}
