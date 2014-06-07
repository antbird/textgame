<?php

class Phenomenon extends \Eloquent {
	protected $fillable = [];

	public function conditions()
    {
        return $this->belongsToMany('Condition');
    }

    public function triggers()
    {
        return $this->belongsToMany('Trigger');
    }
}