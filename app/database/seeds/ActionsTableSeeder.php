<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ActionsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Action::truncate();

		Action::create([
			'name' => 'north',
			'description' => $faker->sentence($nbWords = 6),
		]);
	}	

}