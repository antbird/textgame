<?php

class Condition extends \Eloquent {
	protected $fillable = [];

	public function phenomena()
    {
        return $this->belongsToMany('Phenomenon');
    }
}