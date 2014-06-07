<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhenomenaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phenomena', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('action_id')->unsigned()->index();
			$table->foreign('action_id')->references('id')->on('actions');
			$table->integer('zone_id')->unsigned()->index();
			$table->foreign('zone_id')->references('id')->on('zones');
			$table->integer('new_zone')->unsigned()->index();
			$table->foreign('new_zone')->references('id')->on('zones');
			$table->integer('priority')->index();
			$table->string('description');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('phenomena');
	}

}
