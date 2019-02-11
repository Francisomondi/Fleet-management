<?php

namespace App\Http\Controllers;

use App\ExpCats;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class ExpenseCategories extends Controller {
	public function index(Request $request) {
		$data['data'] = ExpCats::paginate(10);

		return view("expense.cats", $data);
	}
	public function create(Request $request) {

		return view("expense.catadd");
	}

	public function destroy(Request $request) {
		ExpCats::find($request->get('id'))->expense()->forceDelete();
		ExpCats::find($request->get('id'))->forceDelete();

		return redirect()->route('expensecategories.index');
	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:expense_cat',
			'cost' => 'required|integer',

		]);
		if ($validator->fails()) {

			return redirect('expensecategories/create')
				->withErrors($validator)
				->withInput();
		}

		ExpCats::create([
			"name" => $request->get("name"),
			"user_id" => Auth::id(),
			"cost" => $request->get("cost"),
			"frequancy" => $request->get("frequancy"),

		]);

		return Redirect::route("expensecategories.index");

	}

	public function edit($id) {
		$index['data'] = ExpCats::whereId($id)->first();
		return view("expense.catedit", $index);
	}

	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',

			'cost' => 'required|integer',

		]);
		if ($validator->fails()) {

			return redirect('expensecategories/' . $request->get("id") . '/edit')
				->withErrors($validator)
				->withInput();
		}
		$user = ExpCats::whereId($request->get("id"))->first();
		$user->name = $request->get("name");
		$user->user_id = Auth::id();
		$user->cost = $request->get("cost");
		$user->frequancy = $request->get("frequancy");

		$user->save();

		return Redirect::route("expensecategories.index");
	}

}
