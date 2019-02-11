<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class UsersController extends Controller {
	public function index() {
		$index['data'] = User::whereUser_type("O")->get();
		return view("users.index", $index);
	}

	public function create() {
		return view("users.create");
	}

	public function destroy(Request $request) {
		User::find($request->get('id'))->forceDelete();
		return redirect()->route('users.index');
	}
	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6',

		]);
		if ($validator->fails()) {

			return redirect('users/create')
				->withErrors($validator)
				->withInput();
		}

		$id = User::create([
			"name" => $request->get("first_name") . " " . $request->get("last_name"),
			"email" => $request->get("email"),
			"password" => bcrypt($request->get("password")),
			"user_type" => "O",
		])->id;

		return Redirect::route("users.index");

	}
	public function edit($id) {
		$index['data'] = User::whereId($id)->first();
		return view("users.edit", $index);
	}

	public function update(Request $request) {

		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|max:255',

		]);
		if ($validator->fails()) {

			return redirect('users/' . $request->get("id") . "/edit")
				->withErrors($validator)
				->withInput();
		}
		$user = User::whereId($request->get("id"))->first();
		$user->name = $request->get("first_name") . " " . $request->get("last_name");
		$user->email = $request->get("email");
		$user->save();
		return Redirect::route("users.index");
	}

}
