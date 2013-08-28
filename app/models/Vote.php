<?php

class Vote extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'vote' => 'required'
	);

	public static function hasVoted($ip, $polls_id)
	{
		return Vote::where('ip_address', '=', $ip)
		->where('polls_id', '=', $polls_id)
		->first();
	}
}
