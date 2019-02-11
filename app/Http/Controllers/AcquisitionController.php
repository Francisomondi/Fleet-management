<?php

namespace App\Http\Controllers;
use App\AcquisitionModel;
use App\acq_cats;
use App\VehicleModel;
use Illuminate\Http\Request;
use Redirect;

class AcquisitionController extends Controller {

	public function edit($id) {
		$index['data'] = AcquisitionModel::whereVehicle_id($id)->first();
		$index['vehicle'] = VehicleModel::whereId($id)->first();
		$index['cats'] = acq_cats::get();
		$index['vehicle_id'] = $id;

		return view("acquisition.edit", $index);

	}

	public function store(Request $request) {

		$details = array();
		if ($request->get("field_type")) {
			foreach ($request->get("field_type") as $key => $val) {
				$xx[$val] = $request->get("field_value")[$key];

			}
			array_push($details, $xx);
		}

		$data = serialize($details);

		$acqusition = AcquisitionModel::firstOrCreate(['vehicle_id' => $request->get("vehicle_id")]);
		$acqusition->details = $data;
		$acqusition->user_id = $request->get("user_id");

		$acqusition->save();
		$request->session()->flash('status', 'Record Saved successfully!!');

		return redirect("acquisition/" . $request->get("vehicle_id") . "/edit");
	}

}
