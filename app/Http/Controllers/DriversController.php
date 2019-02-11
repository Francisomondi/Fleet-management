<?php

namespace App\Http\Controllers;
use App\Drivervehicle;
use App\User;
use App\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use Redirect;
use Validator;

class DriversController extends Controller {
	public function index() {
		//$index['data'] = User::whereUser_type("D")->get();
		$index['data'] = User::whereUser_type("D")->paginate(10);
		return view("drivers.index", $index);
	}

	public function destroy(Request $request) {
		User::find($request->get('id'))->forceDelete();
		UserMeta::whereUser_id($request->get('id'))->forceDelete();
		return redirect()->route('drivers.index');
	}

	public function create() {
		return view("drivers.create");
	}

	public function edit($id) {
		$index['data'] = User::whereId($id)->first();
		return view("drivers.edit", $index);
	}
	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'address' => 'required',
			'econtact' => 'required',
			'phone' => 'required|numeric',
			'license_number' => 'required|alpha_num',
			'emp_id' => 'alpha_num',
			'contract_number' => 'alpha_num',
			'exp_date' => 'required|date|date_format:Y-m-d|after:tomorrow',
			'start_date' => 'date|date_format:Y-m-d',
			'end_date' => 'date|date_format:Y-m-d|after:tomorrow',

		]);
		if ($validator->fails()) {

			return redirect('drivers/' . $request->get("id") . '/edit')
				->withErrors($validator)
				->withInput();
		}
		$user = User::whereId($request->get("id"))->first();
		$user->name = $request->get("first_name") . " " . $request->get("last_name");

		$user->save();
		$id = $request->get('id');
		$fileName1 = "noimage.jpg";
		if (Input::hasFile('driver_image') && Input::file('driver_image')->isValid()) {
			$destinationPath = './uploads'; // upload path
			$extension = Input::file('driver_image')->getClientOriginalExtension();
			$fileName1 = uniqid() . '.' . $extension;
			Input::file('driver_image')->move($destinationPath, $fileName1);
			$meta = UserMeta::whereUser_id($request->get('id'))->first();
			$meta->profile_image = $fileName1;
			$meta->save();
		}

		$fileName2 = "noimage.jpg";
		if (Input::hasFile('license_image') && Input::file('license_image')->isValid()) {
			$destinationPath = './uploads';
			$extension = Input::file('license_image')->getClientOriginalExtension();
			$fileName2 = uniqid() . '.' . $extension;
			Input::file('license_image')->move($destinationPath, $fileName2);
			$meta = UserMeta::whereUser_id($request->get('id'))->first();
			$meta->license_image = $fileName2;
			$meta->save();
		}
		if (Input::hasFile('documents')) {
			$destinationPath = './uploads';
			$extension = Input::file('documents')->getClientOriginalExtension();
			$fileName2 = uniqid() . '.' . $extension;
			Input::file('documents')->move($destinationPath, $fileName2);

			$meta = UserMeta::whereUser_id($request->get('id'))->first();
			$meta->documents = $fileName2;
			$meta->save();
		}

		$meta = UserMeta::whereUser_id($request->get('id'))->first();
		$meta->first_name = $request->get("first_name");
		$meta->last_name = $request->get("last_name");
		$meta->middle_name = $request->get("middle_name");
		$meta->address = $request->get("address");
		$meta->phone = $request->get("phone");
		$meta->start_date = $request->get("start_date");
		$meta->end_date = $request->get("end_date");
		$meta->emp_id = $request->get("emp_id");
		$meta->contract_number = $request->get("contract_number");
		$meta->econtact = $request->get("econtact");
		$meta->license_number = $request->get("license_number");
		$meta->issue_date = $request->get("issue_date");
		$meta->exp_date = $request->get("exp_date");
		$meta->save();

		return Redirect::route("drivers.index");
	}
	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'address' => 'required',
			'econtact' => 'required',
			'phone' => 'required|numeric',
			'license_number' => 'required|alpha_num',
			'emp_id' => 'alpha_num',
			'contract_number' => 'alpha_num',
			'exp_date' => 'required|date|date_format:Y-m-d|after:tomorrow',
			'start_date' => 'date|date_format:Y-m-d',
			'end_date' => 'date|date_format:Y-m-d|after:tomorrow',

		]);
		if ($validator->fails()) {

			return redirect('drivers/create')
				->withErrors($validator)
				->withInput();
		}

		$id = User::create([
			"name" => $request->get("first_name") . " " . $request->get("last_name"),
			"email" => $request->get("email"),
			"password" => bcrypt($request->get("password")),
			"user_type" => "D",
		])->id;
		$meta = new UserMeta();
		$meta->user_id = $id;
		$meta->first_name = $request->get("first_name");
		$meta->last_name = $request->get("last_name");
		$meta->middle_name = $request->get("middle_name");
		$meta->address = $request->get("address");
		$meta->phone = $request->get("phone");
		$meta->start_date = $request->get("start_date");
		$meta->end_date = $request->get("end_date");
		$meta->emp_id = $request->get("emp_id");
		$meta->contract_number = $request->get("contract_number");
		$meta->econtact = $request->get("econtact");
		$meta->license_number = $request->get("license_number");
		$meta->issue_date = $request->get("issue_date");
		$meta->exp_date = $request->get("exp_date");
		$meta->save();
		$fileName1 = "noimage.jpg";
		if (Input::hasFile('driver_image') && Input::file('driver_image')->isValid()) {
			$destinationPath = './uploads'; // upload path
			$extension = Input::file('driver_image')->getClientOriginalExtension();
			$fileName1 = uniqid() . '.' . $extension;
			Input::file('driver_image')->move($destinationPath, $fileName1);

			$meta = UserMeta::whereUser_id($id)->first();
			$meta->profile_image = $fileName1;
			$meta->save();
		}

		$fileName2 = "noimage.jpg";
		if (Input::hasFile('license_image') && Input::file('license_image')->isValid()) {
			$destinationPath = './uploads';
			$extension = Input::file('license_image')->getClientOriginalExtension();
			$fileName2 = uniqid() . '.' . $extension;
			Input::file('license_image')->move($destinationPath, $fileName2);

			$meta = UserMeta::whereUser_id($id)->first();
			$meta->license_image = $fileName2;
			$meta->save();
		}
		if (Input::hasFile('documents')) {
			$destinationPath = './uploads';
			$extension = Input::file('documents')->getClientOriginalExtension();
			$fileName2 = uniqid() . '.' . $extension;
			Input::file('documents')->move($destinationPath, $fileName2);

			$meta = UserMeta::whereUser_id($id)->first();
			$meta->documents = $fileName2;
			$meta->save();
		}

		return Redirect::route("drivers.index");

	}

	public function enable($id) {
		$driver = UserMeta::whereUser_id($id)->first();
		$driver->is_active = 1;
		$driver->save();
		return Redirect::route("drivers.index");

	}

	public function disable($id) {
		$driver = UserMeta::whereUser_id($id)->first();
		$driver->is_active = 0;
		$driver->save();
		return Redirect::route("drivers.index");

	}

	public function assign($id) {
		$data['drivers'] = User::whereUser_type("D")->get();
		$data['vid'] = $id;
		return view("drivers.assign", $data);
	}

	public function add(Request $request) {
		$dl = new Drivervehicle;
		$dl->whereDriver_id($request->get("assign"))->whereVehicle_id($request->get("vehicle_id"))->delete();

		$drivervehicle = new Drivervehicle;
		$drivervehicle->driver_id = $request->get("assign");
		$drivervehicle->vehicle_id = $request->get("vehicle_id");
		$drivervehicle->user_id = Auth::user()->id;
		$drivervehicle->save();

		return Redirect::route("vehicles.index");
	}
}
