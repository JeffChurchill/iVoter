<?php

class VotesController extends BaseController {

	protected $vote;

	// inject the models into the controller
	public function __construct( Vote $vote)
	{
		$this->vote = $vote;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$v = Validator::make($input, Vote::$rules);
		if($v->passes()) {
			$voteData = array(
				'answers_id' => $input['vote'],
				'polls_id' => $input['pid'],
				'ip_address' => $input['uip'],
			);
			$vote = $this->vote->create($voteData);
			return Redirect::route('polls.show', $input['pid']);
		}
		return Redirect::route('polls.show', $input['pid'])
		->withInput()
		->withErrors($v)
		->with('message', 'There were validation errors');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
