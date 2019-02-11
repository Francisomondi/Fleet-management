<?php

namespace App\Http\Controllers;

use App\ExpCats;
use App\Expense;
use App\VehicleModel;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;

class ExpenseController extends Controller {
	public function index(Request $request) {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['types'] = ExpCats::get();
		$data['today'] = Expense::whereDate('created_at', DB::raw('CURDATE()'))->get();

		$data['total'] = Expense::whereDate('created_at', DB::raw('CURDATE()'))->sum('amount');

		return view("expense.index", $data);
	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'vehicle_id' => 'required',
			'expense_type' => 'required',
			'revenue' => 'required',

		]);
		if ($validator->fails()) {

			return redirect('expense')
				->withErrors($validator)
				->withInput();
		}
		Expense::create([
			"vehicle_id" => $request->get("vehicle_id"),
			"amount" => $request->get("revenue"),
			"user_id" => Auth::id(),
			"date" => $request->get('date'),
			"comment" => $request->get('comment'),
			"expense_type" => $request->get("expense_type"),
		]);

		return redirect()->route("expense.index");
	}

}
