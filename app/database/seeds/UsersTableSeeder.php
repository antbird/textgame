<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		User::truncate();

		foreach(range(1, 10) as $index)
		{
			User::create([
				'name' => str_replace('.', '', $faker->unique()->userName),
                'email' => $faker->unique()->email,
                'password' => Hash::make('password'),
                'zone_id' => 1,
			]);
		}
	}

}