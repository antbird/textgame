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

	return $action;

	$phenomena = Phenomenon::with('condition', 'trigger') //go through each phenomenon based on priority and matching conditions
		->where('action', '=', $id)
		->orderBy('priority', 'desc')
		->get();

	//execute triggers for matching phenomenon

	/* print out current zone name & description
	(basic, later we'll push json data to update each affected gui panel) */
	return Zone::find($player->zone_id);
});