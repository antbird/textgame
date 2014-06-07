<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ZonesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Zone::truncate();

		foreach(range(1, 10) as $index)
		{
			Zone::create([
				'name' => ($faker->cityPrefix . ' ' . $faker->safeColorName . ' ' . $faker->citySuffix),
                'description' => $faker->paragraph($nbSentences = 3),                
			]);
		}
	}

}