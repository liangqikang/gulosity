<?php

class Log extends Eloquent{

	protected $fillable = array('log', 'operator', 'type');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'log';


}