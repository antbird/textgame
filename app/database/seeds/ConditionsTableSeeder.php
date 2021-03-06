<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ConditionsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Condition::create([		
			'name' => 'Player_is_admin',
			'field' => 'player.id',
			'value' => 1,
			'description' => 'You are not an admin!',
		]);	
	}

}