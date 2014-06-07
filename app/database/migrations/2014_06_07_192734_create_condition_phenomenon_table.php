<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConditionPhenomenonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('condition_phenomenon', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('condition_id')->unsigned()->index();
			$table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
			$table->integer('phenomenon_id')->unsigned()->index();
			$table->foreign('phenomenon_id')->references('id')->on('phenomena')->onDelete('cascade');
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
		Schema::drop('condition_phenomenon');
	}

}
