<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivervehicle extends Model {

	protected $table = "driver_vehicle";
	protected $fillable = [
		'driver_id', 'vehicle_id', 'user_id',
	];

	function vehicle() {
		return $this->BelongsTo("App\VehicleModel", "id", "vehicle_id");
	}

	function user() {
		return $this->hasOne("App\User", "id", "driver_id");
	}

}
