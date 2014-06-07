<?php

class Trigger extends \Eloquent {
	protected $fillable = [];

	public function phenomena()
    {
        return $this->belongsToMany('Phenomenon');
    }
}