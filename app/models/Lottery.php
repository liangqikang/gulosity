<?php

class Lottery extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lottery';
	
	protected $fillable = array('user_id','prize', 'count');
}