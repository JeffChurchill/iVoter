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
	public static function getTally($polls_id)
	{
		return DB::Table('votes')
		->select(DB::raw('COUNT(id) as votes, answers_id'))
		->where('polls_id', '=', $polls_id)
		->groupBy('answers_id')
		->get();
	}

	public static function getTotalCount($polls_id)
	{
		return DB::Table('votes')
		->select(DB::raw('COUNT(id) as totalVotes'))
		->where('polls_id', '=', $polls_id)
		->get();
	}


}
