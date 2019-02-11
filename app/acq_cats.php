<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class acq_cats extends Model {
	protected $fillable = [
		'name',
	];
	protected $table = "acquisition_cats";
	public $timestamps = false;
}
