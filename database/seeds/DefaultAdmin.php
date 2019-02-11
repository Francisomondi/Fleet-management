<?php

use App\User;
use Illuminate\Database\Seeder;

class DefaultAdmin extends Seeder {

	public function run() {
		DB::table('users')->truncate();
		$new = new User();
		$new->name = "Super Administrator";
		$new->email = "master@admin.com";
		$new->password = bcrypt('admin');
		$new->user_type = "S";
		$new->save();

	}
}
