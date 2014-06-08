<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		Zone::truncate();
		User::truncate();
		Action::truncate();
		Phenomenon::truncate();
		
		$this->call('ZonesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('ActionsTableSeeder');
		$this->call('PhenomenaTableSeeder');
		$this->call('ConditionsTableSeeder');
	}

}
