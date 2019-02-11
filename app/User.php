<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

	use SoftDeletes;
	use Notifiable;
	protected $dates = ['deleted_at'];

	protected $fillable = [
		'name', 'email', 'password', 'user_type',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function get_detail() {
		return $this->hasOne("App\UserMeta");
	}

	public function vehicle() {
		return $this->hasOne("App\Drivervehicle", "driver_id", "id");
	}
}