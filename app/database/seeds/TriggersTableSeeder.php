<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TriggersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Trigger::create([
			
		]);	
	}

}