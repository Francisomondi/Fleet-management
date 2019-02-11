<?php
namespace App;
use App\Settings;
use Cache;

Class Hyvikk {
	public static function get($key) {
		static $settings;

		if (is_null($settings)) {
			$settings = Cache::remember('settings', 1 * 60, function () {
				return array_pluck(Settings::all()->toArray(), 'value', 'name');
			});
		}

		return (is_array($key)) ? array_only($settings, $key) : $settings[$key];
	}
	public static function set($key, $val) {
		$settings = Settings::firstOrNew(array('name' => $key));
		$settings->value = $val;
		$settings->save();
		Cache::flush();
	}
}