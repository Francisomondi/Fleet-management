<?php

namespace App\Http\Controllers;

use App\IncCats;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class IncomeCategories extends Controller {
	public function index(Request $request) {
		$data['data'] = IncCats::paginate(10);

		return view("income.cats", $data);
	}
	public function create(Request $request) {

		return view("income.catadd");
	}

	public function destroy(Request $request) {
		IncCats::find($request->get('id'))->income()->forceDelete();
		IncCats::find($request->get('id'))->forceDelete();

		return redirect()->route('incomecategories.index');
	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:income_cat',

		]);
		if ($validator->fails()) {

			return redirect('incomecategories/create')
				->withErrors($validator)
				->withInput();
		}

		IncCats::create([
			"name" => $request->get("name"),
			"user_id" => Auth::id(),
			"cost" => $request->get("cost"),

		]);

		return Redirect::route("incomecategories.index");

	}

	public function edit($id) {
		$index['data'] = IncCats::whereId($id)->first();
		return view("income.catedit", $index);
	}

	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',

		]);
		if ($validator->fails()) {

			return redirect('incomecategories/' . $request->get("id") . '/edit')
				->withErrors($validator)
				->withInput();
		}
		$user = IncCats::whereId($request->get("id"))->first();
		$user->name = $request->get("name");
		$user->user_id = Auth::id();
		$user->cost = $request->get("cost");

		$user->save();

		return Redirect::route("incomecategories.index");
	}

}
