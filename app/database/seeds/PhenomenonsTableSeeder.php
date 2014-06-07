<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhenomenonsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Phenomenon::create([
			[
				'name' => 'Traverse north from zone 1 to zone 2.',
				'action_id' => 1
				'priorty' => 75,
				'description' => $faker->paragraph($nbSentences = 3),
			],
			[
				'name' => 'Traverse north from zone 2 to zone 3.',
				'action_id' => 1
				'priorty' => 75,
				'description' => $faker->paragraph($nbSentences = 3),
			],
			[
				'name' => 'Attempt to traverse north when nothing is north.',
				'action_id' => 1
				'priorty' => 0,
				'description' => $faker->paragraph($nbSentences = 3),
			]
		]);
	}
}