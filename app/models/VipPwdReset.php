<?php

class VipPwdReset extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vip_pwd_reset';
	
	protected $fillable = array('vip_id','status');

	public function vip()
    {
        return $this->belongsTo('Vip');
    }

}