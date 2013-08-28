<?php

class Answer extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function votes()
	{
		return $this->hasMany('Vote', 'answers_id');
	}
	public static function countVotesForThisAnswer($answers_id)
	{
		return DB::Table('votes')
		->select(DB::raw('COUNT(id) as voteCount'))
		->where('answers_id', '=', $answers_id)
		->get();
	}
}
