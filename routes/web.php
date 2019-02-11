<?php

Auth::routes();
Route::get("/", 'HomeController@index')->middleware(['lang_check', 'auth']);
Route::group(['middleware' => ['lang_check', 'auth', 'officeadmin']], function () {
	Route::resource('/drivers', 'DriversController');
	Route::resource('/parts', 'PartsController');
	Route::resource('/vehicles', 'VehiclesController');
	Route::resource('/acquisition', 'AcquisitionController');
	Route::resource('/income', 'Income');
	Route::resource('/stock', 'StockController');
	Route::resource('/bookings', 'BookingsController');
	Route::resource('/customers', 'CustomersController');
	Route::resource('/transaction', 'PartsTransaction');
	Route::resource('/expense', 'ExpenseController');
	Route::resource('/acq', 'AcqController');
	Route::get('/bookings/complete/{id}', 'BookingsController@complete');
	Route::get('/bookings/receipt/{id}', 'BookingsController@receipt');
	Route::post('/bookings/complete', 'BookingsController@complete_post')->name("bookings.complete");
	Route::resource('/settings', 'SettingsController');
	Route::resource('/expensecategories', 'ExpenseCategories');
	Route::resource('/incomecategories', 'IncomeCategories');
	Route::get("/reports/monthly", "ReportsController@monthly")->name("reports.monthly");
	Route::post("/reports/monthly", "ReportsController@monthly_post")->name("reports.monthly");
	Route::get("/reports/parts", "ReportsController@parts")->name("reports.parts");
	Route::get("/reports/booking", "ReportsController@booking")->name("reports.booking");
	Route::post("/reports/booking", "ReportsController@booking_post")->name("reports.booking");
	Route::post("/reports/parts", "ReportsController@parts_post")->name("reports.parts");
	Route::get("/reports/delinquent", "ReportsController@delinquent")->name("reports.delinquent");
	Route::post("/reports/delinquent", "ReportsController@delinquent_post")->name("reports.delinquent");

	Route::get('/stock/add/{id}', 'StockController@add');
	Route::get("/drivers/assign/{id}", 'DriversController@assign');
	Route::post('/drivers/add', 'DriversController@add');
	Route::get("/drivers/enable/{id}", 'DriversController@enable');
	Route::get("/drivers/disable/{id}", 'DriversController@disable');
	Route::resource('/searchvehicles', 'SearchvehiclesController');
	Route::post('/searchvehicles/search', 'SearchvehiclesController@search');
	Route::resource("/searchparts", 'SearchpartsController');
	Route::post('/searchparts/search', 'SearchpartsController@search');

	Route::resource('/searchdrivers', 'SearchdriversController');
	Route::post('/searchdrivers/search', 'SearchdriversController@search');
});
Route::group(['middleware' => ['lang_check', 'auth']], function () {
	Route::get('/changepass/{id}', 'UtilityController@changepass')->name("changepass");
	Route::post('/changepass/{id}', 'UtilityController@changepassword')->name("changepass");
});
Route::group(['middleware' => ['lang_check', 'auth', 'superadmin']], function () {
	Route::resource('/users', 'UsersController');
});