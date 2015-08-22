<?php

class MyLog extends Eloquent{

	protected $fillable = array('order_id', 'log', 'type');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'log';


}