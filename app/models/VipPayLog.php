<?php

class VipPayLog extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vip_pay_log';
	
	protected $fillable = array('vip_id','money','type','status');

	public function vip()
    {
        return $this->belongsTo('Vip');
    }

}