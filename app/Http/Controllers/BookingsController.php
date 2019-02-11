<?php

namespace App\Http\Controllers;
use App\BookingIncome;
use App\Bookings;
use App\Customers;
use App\Http\Requests\BookingRequest;
use App\IncCats;
use App\IncomeModel;
use App\Mail\DriverBooked;
use App\Mail\VehicleBooked;
use App\VehicleModel;
use DB;
use Illuminate\Http\Request;
use Mail;

class BookingsController extends Controller {
	public function index() {
		$data['data'] = Bookings::orderBy('id', 'desc')->get();
		return view("bookings.index", $data);
	}

	public function complete($id) {
		$data = Bookings::find($id);

		if ($data != null) {
			$view['data'] = $data->first();
			$view['types'] = IncCats::all();
			return view("bookings.complete", $view);
		}
	}

	public function complete_post(Request $request) {

		$id = IncomeModel::create([
			"vehicle_id" => $request->get("vehicle_id"),
			"amount" => $request->get("revenue"),
			"user_id" => $request->get("user_id"),
			"date" => $request->get('date'),
			"mileage" => $request->get("mileage"),
			"income_cat" => $request->get("income_type"),
		])->id;
		BookingIncome::create(['booking_id' => $request->get("booking_id"), "income_id" => $id]);
		$xx = Bookings::whereId($request->get("booking_id"))->first();
		$xx->status = 1;
		$xx->save();
		return redirect()->route("bookings.index");

	}
	public function receipt($id) {
		$data['i'] = BookingIncome::whereBooking_id($id)->first();
		$data['info'] = IncomeModel::whereId($data['i']->id)->first();
		return view("bookings.receipt", $data);

	}
	public function create() {
		$data['customers'] = Customers::all();
		$data['vehicles'] = VehicleModel::whereIn_service("1")->get();
		return view("bookings.create", $data);
	}

	public function edit($id) {

		$index['customers'] = Customers::all();
		$index['vehicles'] = VehicleModel::whereIn_service("1")->get();
		$index['data'] = Bookings::whereId($id)->first();
		return view("bookings.edit", $index);
	}

	public function destroy(Request $request) {
		Bookings::find($request->get('id'))->forceDelete();

		return redirect()->route('bookings.index');
	}
	public function store(BookingRequest $request) {

		$xx = $this->check_booking($request->get("from_date"), $request->get("to_date"), $request->get("vehicle_id"));
		if ($xx) {
			$id = Bookings::create($request->all())->id;
			$booking = Bookings::find($id);
			$mail = $booking->first();
			//$y->vehicle->driver->user
			Mail::to($mail->customer->email)->send(new VehicleBooked($booking));
			Mail::to($mail->vehicle->driver->user->email)->send(new DriverBooked($booking));
			return redirect()->route("bookings.index");
		} else {
			return redirect()->route("bookings.create")->withErrors(["error" => "Selected Vehicle is not Available in Given Dates"])
				->withInput();
		}

	}
	protected function check_booking($from_date, $to_date, $vehicle) {

		$chk = DB::table("bookings")
			->where("status", 0)
			->where("vehicle_id", $vehicle)
			->whereNull("deleted_at")
			->where("from_date", ">=", $from_date)
			->where("to_date", "<=", $to_date)
			->get();

		if (count($chk) > 0) {
			return false;
		} else {
			return true;
		}

	}
	public function update(Request $request) {
		$xx = $this->check_booking($request->get("from_date"), $request->get("to_date"), $request->get("vehicle_id"));
		if ($xx) {
			$booking = Bookings::whereId($request->get("id"))->first();
			$booking->customer_id = $request->get("customer_id");
			$booking->vehicle_id = $request->get("vehicle_id");
			$booking->travellers = $request->get("travellers");
			$booking->from_date = $request->get("from_date");
			$booking->to_date = $request->get("to_date");
			$booking->pickup_time = $request->get("pickup_time");
			$booking->pickup_addr = $request->get("pickup_addr");
			$booking->dest_addr = $request->get("dest_addr");

			$booking->save();
			return redirect()->route("bookings.index");
		} else {
			return redirect("/bookings/" . $request->get("id") . "/edit")->withErrors(["error" => "Selected Vehicle is not Available in Given Dates"])->withInput();

		}

		return redirect()->route('bookings.index');

	}
}
