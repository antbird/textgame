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
			'priority' => 75,
			'description' => $faker->paragraph($nbSentences = 3),
		]);
		
		Phenomenon::create([
			'name' => 'Traverse north from zone 2 to zone 3.',
			'action_id' => 1,
			'priority' => 75,
			'description' => $faker->paragraph($nbSentences = 3),
		]);
		
		Phenomenon::create([
			'name' => 'Attempt to traverse north when nothing is north.',
			'action_id' => 1,
			'priority' => 0,
			'description' => $faker->paragraph($nbSentences = 3),		
		]);
	}
}