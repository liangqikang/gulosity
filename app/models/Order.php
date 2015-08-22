<?php

class Order extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'order';
	
	protected $fillable = array('user_id','order_no','num','status','pay_type','pay_status','address_id','comment','total_price','prize','delivery_time', 'fapiao_type', 'fapiao_title', 'operator');

	public function foods()
    {
        return $this->belongsToMany('Food', 'order_food')->withPivot('count', 'count', 'allplus', 'allplus');
    }

    public function orderFoods()
    {
        return $this->hasMany('OrderFood');
    }
}