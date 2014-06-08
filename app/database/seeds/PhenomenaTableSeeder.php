<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhenomenaTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Phenomenon::create([
			'name' => 'Traverse north from zone 1 to zone 2.',
			'action_id' => 1,
			'zone_id' => 1,
			'new_zone' => 2,
			'priority' => 75,
			'description' => $faker->paragraph($nbSentences = 3),
		]);
		
		Phenomenon::create([
			'name' => 'Traverse north from zone 2 to zone 3.',
			'action_id' => 1,
			'zone_id' => 2,
			'new_zone' => 3,
			'priority' => 75,
			'description' => $faker->paragraph($nbSentences = 3),
		]);

		Phenomenon::create([
			'name' => 'ADMIN: Traverse north from zone 3 to zone 4.',
			'action_id' => 1,
			'zone_id' => 3,
			'new_zone' => 4,
			'priority' => 75,
			'description' => $faker->paragraph($nbSentences = 3),
		]);
		
		Phenomenon::create([
			'name' => 'Attempt to traverse north when nothing is north.',
			'action_id' => 1,
			'zone_id' => 0,
			'new_zone' => 0,
			'priority' => 0,
			'description' => $faker->paragraph($nbSentences = 3),		
		]);
	}
}