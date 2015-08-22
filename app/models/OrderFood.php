<?php

class OrderFood extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'order_food';

	public function food()
    {
        return $this->hasOne('Food');
    }


}