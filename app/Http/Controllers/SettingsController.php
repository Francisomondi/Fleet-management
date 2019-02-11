<?php

namespace App\Http\Controllers;
use App\Settings;
use Cache;
use Illuminate\Http\Request;
use Redirect;

class SettingsController extends Controller {

	public function index() {
		$data['settings'] = Settings::all();
		return view("utilities.settings", $data);
	}
	public function store(Request $request) {
		foreach ($request->get('name') as $key => $val) {
			Settings::where('name', $key)->update(['value' => $val]);
		}
		Cache::flush();
		return Redirect::route("settings.index");
	}
}
