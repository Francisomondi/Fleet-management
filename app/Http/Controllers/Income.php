<?php

namespace App\Http\Controllers;

use App\IncCats;
use App\IncomeModel;
use App\VehicleModel;
use Auth;
use DB;
use Illuminate\Http\Request;

class Income extends Controller {
	public function index(Request $request) {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['types'] = IncCats::get();
		$data['today'] = IncomeModel::whereDate('created_at', DB::raw('CURDATE()'))->get();
		$data['total'] = IncomeModel::whereDate('created_at', DB::raw('CURDATE()'))->sum('amount');
		return view("income.index", $data);

	}

	public function store(Request $request) {

		IncomeModel::create([
			"vehicle_id" => $request->get("vehicle_id"),
			"amount" => $request->get("revenue"),
			"user_id" => Auth::id(),
			"date" => $request->get('date'),
			"mileage" => $request->get("mileage"),
			"income_cat" => $request->get("income_type"),
		]);
		$v = VehicleModel::find($request->get("vehicle_id"));

		$v->mileage = $request->get("mileage");
		$v->save();
		return redirect()->route("income.index");
	}

}
