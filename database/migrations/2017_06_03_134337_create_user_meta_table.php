<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateUserMetaTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('user_meta', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('first_name', 255);
			$table->string('last_name', 255);
			$table->string('middle_name', 255)->nullable();
			$table->string('address', 255)->nullable();
			$table->string('phone', 255)->nullable();
			$table->date('issue_date')->nullable();
			$table->string('license_number', 20)->nullable();
			$table->date('exp_date')->nullable();
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->string('emp_id')->nullable();
			$table->string('contract_number')->nullable();
			$table->string('documents')->nullable();
			$table->text('econtact')->nullable();

			$table->string('license_image', 30)->nullable();
			$table->string('profile_image', 30)->nullable();
			$table->tinyInteger('is_active')->default(1);
			$table->nullableTimestamps();
			$table->softDeletes();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('user_meta');
	}
}
