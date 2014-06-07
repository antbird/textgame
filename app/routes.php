<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('zones', 'ZonesController');
Route::resource('actions', 'ActionsController');
Route::resource('phenomenons', 'PhenomenonsController');

//MASTER COMPUTER
Route::get('action/{id}', function($id)
{
	$player = User::find(1); //use session in production

	$action = Action::find($id);
	if (!$action) {
		return "Invalid action.";
	}

	//possible action type? different controller routing | movement/combat/item use/etc	

	$phenomena = Phenomenon::with(['conditions', 'triggers']) //go through each phenomenon based on priority and matching conditions
		->where('action_id', '=', $id)
		->where('zone_id', '=', $player->zone_id)
		->orWhere('zone_id', '=', 0)
		->orderBy('priority', 'desc')
		->get();

		//var_dump($phenomena['triggers']); die();

	//return $phenomena;

	function determineTriggers($phenomena)
	{
		$triggers = [];

		foreach ($phenomena as $phenomenon) 
		{
			$conditionCount = count($phenomenon->conditions);
			$conditionsMet = 0;

			foreach ($phenomenon->conditions as $condition)
			{
				// if condition is met, $conditionsMet++;
			}
			
			if ($conditionCount === $conditionsMet) {
				$triggers = $phenomenon->triggers;
				if ($phenomenon->new_zone != 0) {					
					$triggers['player.zone_id'] = $phenomenon->new_zone;
				}
				return $triggers;
			}
		}		
	}

	$triggers = determineTriggers($phenomena);	

	//return $triggers;

	$models = [];

	foreach ($triggers as $key => $value) 
	{
		// this will have to be its own utility/controller elsewhere
		// as there will be a lot of different combinations of fields
		// and tables		

		$arguments = explode('.', $key);

		if ($arguments[0] == "player") {
			$model = 'User';
			$target = 1;
		}

		if ($arguments[1] == 'zone_id') { //pull from an array of variables
			$field = 'zone_id';			
		}

		if (!array_key_exists($model, $models)) {
			$models["{$model}"] = [];
		}

		if (!array_key_exists($target, $models["{$model}"])) {
			$models["{$model}"]["{$target}"]["{$field}"] = $value;
		}

	}

	//return $models;

	foreach ($models as $model => $updating) 
	{
		echo $model,'<br>';
		var_dump($updating); die();


	}


	if ($query) {
		$results = DB::select(
			DB::raw("SELECT * FROM some_table WHERE some_col = :somevariable"),
			array('somevariable' => $someVariable)
		);
	}
	

	//execute triggers for matching phenomenon
		//do all associated triggers
		//then, if phenomenon.new_zone is not 0, set player.zone_id to phenomenon.new_zone

	/* print out current zone name & description
	(basic, later we'll push json data to update each affected gui panel) */
	//return Zone::find($player->zone_id);
});