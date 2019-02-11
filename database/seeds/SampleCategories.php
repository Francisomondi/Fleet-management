<?php

use App\acq_cats;
use App\Customers;
use App\ExpCats;
use App\IncCats;
use App\VehicleModel;
use Illuminate\Database\Seeder;

class SampleCategories extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->import_income_categories();
		$this->import_expense_categories();
		$this->import_acq_categories();
		$this->add_customers();
		$this->add_vehicles();
	}
	private function add_vehicles() {
		DB::table('vehicles')->truncate();
		$vehicle1 = [
			'make' => 'Honda',
			'model' => 'Accord',
			'type' => 'TESDF',
			'year' => '2012',
			'engine_type' => 'Petrol',
			'horse_power' => '190',
			'color' => 'Red',
			'vin' => '2342342',
			'license_plate' => '234523kg',
			'mileage' => '45464',
			'in_service' => '1',
			'user_id' => '1',
			'int_mileage' => 10,
		];

		VehicleModel::create($vehicle1);
	}
	private function add_customers() {
		DB::table('customers')->truncate();
		$customer1 = [
			'name' => 'Customer 1',
			'email' => 'customeremail@gmail.com',
			'phone' => '1234567890',
			'address1' => 'Customer address line 1',
			'address2' => 'Customer address line 2',
			'zipcode' => '00420',
			'city' => 'Mumbai',

		];
		$customer2 = [
			'name' => 'Customer 2',
			'email' => 'customer2email@gmail.com',
			'phone' => '1234567822',
			'address1' => 'Customer2 address line 1',
			'address2' => 'Customer2 address line 2',
			'zipcode' => '01420',
			'city' => 'Delhi',

		];
		Customers::create($customer1);
		Customers::create($customer2);
	}
	private function import_acq_categories() {
		DB::table('acquisition_cats')->truncate();
		$data = array(
			array(
				'name' => 'Sticker',
			),
			array(
				'name' => 'Kilometer Meter',
			),
			array(
				'name' => 'customs',
			),
			array(
				'name' => 'Paint',
			),
			array(
				'name' => 'Technical Visit',
			),
			array(
				'name' => 'Fire Extinguisher',
			),
			array(
				'name' => 'RTI',
			),
			array(
				'name' => 'Transportation Card',
			),
			array(
				'name' => 'Purchase Price',
			),
		);
		foreach ($data as $rec) {
			acq_cats::create($rec);
		}

	}
	private function import_expense_categories() {
		DB::table('expense_cat')->truncate();
		$data = array(
			array(
				'name' => 'Insurance',
				'user_id' => '1',
				'cost' => '42500.00',
				'frequancy' => 'Monthly',
			),
			array(
				'name' => 'Patente',
				'user_id' => '1',
				'cost' => '60000.00',
				'frequancy' => 'Quarterly',
			),
			array(
				'name' => 'Mechanics',
				'user_id' => '1',
				'cost' => '30000.00',
				'frequancy' => 'Monthly',
			),
			array(
				'name' => 'Car wash',
				'user_id' => '1',
				'cost' => '1000.00',
				'frequancy' => 'Weekly',
			),
			array(
				'name' => 'Vignette',
				'user_id' => '1',
				'cost' => '3000.00',
				'frequancy' => 'Yearly',
			),
			array(
				'name' => 'Maintenance',
				'user_id' => '14',
				'cost' => '5678.00',
				'frequancy' => 'Daily',
			),
			array(
				'name' => 'Parking',
				'user_id' => '14',
				'cost' => '18000.00',
				'frequancy' => 'Yearly',
			),
		);
		foreach ($data as $rec) {
			ExpCats::create($rec);
		}

	}
	private function import_income_categories() {
		DB::table('income_cat')->truncate();
		$data = array(
			array(
				'name' => 'Ragular Day',
				'user_id' => '1',
				'cost' => '17000.00',
			),
			array(
				'name' => 'Holiday',
				'user_id' => '1',
				'cost' => '15000.00',
			),
			array(
				'name' => 'Sunday',
				'user_id' => '1',
				'cost' => '18000.00',
			),
			array(
				'name' => 'Booking',
				'user_id' => '1',
				'cost' => '0.00',
			),
		);
		foreach ($data as $rec) {
			IncCats::create($rec);
		}

	}
}
