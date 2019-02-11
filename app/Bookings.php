<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "bookings";
	protected $fillable = [
		'customer_id', 'vehicle_id', 'user_id', 'pickup_time', 'from_date', 'to_date', 'pickup_addr', 'dest_addr', 'travellers', 'status',
	];

	function vehicle() {
		return $this->hasOne("App\VehicleModel", "id", "vehicle_id");
	}
	function customer() {
		return $this->hasOne("App\Customers", "id", "customer_id");
	}
}
