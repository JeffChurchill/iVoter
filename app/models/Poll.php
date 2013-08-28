<?php

class Poll extends Eloquent {

	protected $guarded = array();

	public static $rules = array(
		'topic' => 'required'
	);

	// set relations
	public function answers()
	{
		return $this->hasMany('Answer', 'polls_id')
		->orderBy('answers.updated_at', 'asc');
	}
	public function votes()
	{
		return $this->hasMany('Vote', 'polls_id');
	}
}
