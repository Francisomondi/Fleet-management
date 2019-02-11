<?php

namespace App\Http\Controllers;
use App\VehicleModel;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class VehiclesController extends Controller {
	public function index() {
		$index['data'] = VehicleModel::paginate(10);
		return view("vehicles.index", $index);
	}

	public function create() {
		return view("vehicles.create");
	}
	
	public function destroy(Request $request) {
		VehicleModel::find($request->get('id'))->income()->forceDelete();
		VehicleModel::find($request->get('id'))->expense()->forceDelete();
		VehicleModel::find($request->get('id'))->forceDelete();
		return redirect()->route('vehicles.index');
	}

	public function edit($id) {
		$index['data'] = VehicleModel::whereId($id)->first();
		$index['vehicle_id'] = $id;
		return view("vehicles.edit", $index);
	}

	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'make' => 'required',
			'model' => 'required',
			'year' => 'required|numeric',
			'engine_type' => 'required|',
			'horse_power' => 'required|integer',
			'color' => 'required',
			'vin' => 'required',
			'license_plate' => 'required',
			'int_mileage' => 'required|alpha_num',

		]);
		if ($validator->fails()) {
			return redirect('vehicles/' . $request->get("id") . '/edit')
				->withErrors($validator)
				->withInput();
		}
		$user = VehicleModel::find($request->get("id"));
		$user->update($request->all());
		if ($request->get("in_service")) {
			$user->in_service = 1;
		} else {
			$user->in_service = 0;
		}
		$user->mileage = $request->get("int_mileage");
		$user->save();
		return Redirect::route("vehicles.index");

	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'make' => 'required',
			'model' => 'required',
			'year' => 'required|numeric',

			'engine_type' => 'required|',
			'horse_power' => 'required|integer',
			'color' => 'required',
			'vin' => 'required',
			'license_plate' => 'required',
			'int_mileage' => 'required|alpha_num',

		]);
		if ($validator->fails()) {

			return redirect('vehicles/create')
				->withErrors($validator)
				->withInput();
		}

		$vehicle_id = VehicleModel::create($request->all())->id;

		$v = VehicleModel::find($vehicle_id);

		$v->mileage = $request->get("int_mileage");
		$v->save();

		return Redirect::route("vehicles.index");
	}

}
