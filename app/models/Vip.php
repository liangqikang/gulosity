<?php

class Vip extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vip';
	
	protected $fillable = array('user_id','mobile','email','balance');

}