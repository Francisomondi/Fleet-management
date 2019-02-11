<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class AcquisitionModel extends Model {

	protected $table = "acquisition";
	protected $fillable = [
		'vehicle_id', 'details', 'user_id',
	];

}
