<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhenomenonTriggerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phenomenon_trigger', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('phenomenon_id')->unsigned()->index();
			$table->foreign('phenomenon_id')->references('id')->on('phenomena')->onDelete('cascade');
			$table->integer('trigger_id')->unsigned()->index();
			$table->foreign('trigger_id')->references('id')->on('triggers')->onDelete('cascade');
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
		Schema::drop('phenomenon_trigger');
	}

}
