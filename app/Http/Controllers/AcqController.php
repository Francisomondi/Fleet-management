<?php

namespace App\Http\Controllers;

use App\acq_cats;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class AcqController extends Controller {
	public function index(Request $request) {
		$data['data'] = acq_cats::paginate(10);

		return view("acqcats.index", $data);
	}
	public function create(Request $request) {

		return view("acqcats.add");
	}

	public function destroy(Request $request) {
		acq_cats::find($request->get('id'))->forceDelete();

		return redirect()->route('acq.index');
	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:acquisition_cats',

		]);
		if ($validator->fails()) {

			return redirect('acq/create')
				->withErrors($validator)
				->withInput();
		}

		acq_cats::create([
			"name" => $request->get("name"),

		]);

		return Redirect::route("acq.index");

	}

	public function edit($id) {
		$index['data'] = acq_cats::whereId($id)->first();
		return view("acqcats.edit", $index);
	}

	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',

		]);
		if ($validator->fails()) {

			return redirect('acq/' . $request->get("id") . '/edit')
				->withErrors($validator)
				->withInput();
		}
		$user = acq_cats::whereId($request->get("id"))->first();
		$user->name = $request->get("name");

		$user->save();

		return Redirect::route("acq.index");
	}

}
