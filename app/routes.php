<?php

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

	$action = Action::where('id', $id)->pluck('id');

	//return $action;

	if (!$action) {		
		return Zone::find($player->zone_id);
	}

	//possible action type? different controller routing | movement/combat/item use/etc	

	$phenomena = Phenomenon::with(['conditions', 'triggers'])
		->where('action_id', '=', $id)
		->where('zone_id', '=', $player->zone_id)
		->orWhere('zone_id', '=', 0)
		->orderBy('priority', 'desc')
		->get();

	//return $phenomena;

	function mapKeysAndValuesToFields($input)
	{
		$models = [];		

		foreach ($input as $variable) {		
		
			// this will have to be its own utility/controller elsewhere
			// as there will be a lot of different combinations of fields
			// and tables		

			$arguments = explode('.', $variable->field);

			if ($arguments[0] == "player") {
				$model = 'User';
				$target = 1;
			}

			if ($arguments[1] == 'zone_id' || $arguments[1] == 'id') { //pull from an array of variables
				$field = $arguments[1];			
			}

			if (!array_key_exists($model, $models)) {
				$models["{$model}"] = [];
			}
			
			$models["{$model}"]["{$target}"]["{$field}"] = $variable->value;

			return $models;
			
		}

	}

	function determineTriggers($phenomena)
	{
		$triggers = [];

		foreach ($phenomena as $phenomenon) 
		{
			$conditionCount = count($phenomenon->conditions);			
			$conditionsMet = 0;
			$failureText = '';

			$conditions = mapKeysAndValuesToFields($phenomenon->conditions);

			foreach ($conditions as $model => $condition)
			{
				foreach ($condition as $target => $variables) 
				{
					$thing = $model::find($target);

					foreach($variables as $field => $value)
					{
						if ($thing->$field == $value) {
							$conditionsMet++;
						} else {
							$failureText .= $condition->description . "\n";
						}
					}
				}
			}
			
			if ($conditionCount === $conditionsMet) {
				$triggers = mapKeysAndValuesToFields($phenomenon->triggers);
				if ($phenomenon->new_zone != 0) {	//use mutators to enable type-checking 				
					$triggers['User'][1]['zone_id'] = $phenomenon->new_zone;
				}
				return $triggers;
			}
		}		
	}

	$triggers = determineTriggers($phenomena);	
	
	

	//execute triggers for matching phenomenon
		//do all associated triggers
		//then, if phenomenon.new_zone is not 0, set player.zone_id to phenomenon.new_zone

	foreach ($triggers as $model => $trigger)
	{		
		foreach ($trigger as $target => $variables) {
			$thing = $model::find($target);

			foreach($variables as $field => $value)
			{
				$thing->$field = $value;
			}
			$thing->save();
		}
	}

	//Re-polling Player's data to check for updates
	$player = User::find(1); //use session in production

	/* print out current zone name & description
	(basic, later we'll push json data to update each affected gui panel) */
	//Add ability for a "return trigger" or something to echo a message instead of room descript
	return Zone::find($player->zone_id);
});