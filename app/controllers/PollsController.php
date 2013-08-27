<?php

class PollsController extends BaseController {

	protected $poll;
	protected $answer;
	protected $vote;

	// inject the models into the controller
	public function __construct(Poll $poll, Answer $answer, Vote $vote)
	{
		$this->poll = $poll;
		$this->answer = $answer;
		$this->vote = $vote;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		// $polls = Poll::all();
		// $this->layout->content = View::make('polls.index')->with('polls', $polls);
		
		$polls = $this->poll->all();
		$this->layout->content = View::make('polls.index', compact('polls'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// create form
		$this->layout->content = View::make('polls.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$pollArray = array('topic' => $input['topic']);
		$optionsArray = $input['options'];
		$v = Validator::make($input, Poll::$rules);
		if($v->passes()) {
			$poll = $this->poll->create($pollArray);
			// loop through the options array and save to the db
			foreach ($optionsArray as $option) {
				$optPayload = array(
					'content' => $option,
					'polls_id' => $poll->id
				);
				$this->answer->create($optPayload);
			}
			return Redirect::route('polls.index');
		}
		return Redirect::route('polls.create')
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
		// get the poll with id of $id and pass it to the view
		$poll = $this->poll->findOrFail($id);
		$this->layout->content = View::make('polls.show', compact('poll'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$poll = $this->poll->find($id);
		if(is_null($poll)) {
			return Redirect::route('polls.index');
		}
		$this->layout->content = View::make('polls.edit', compact('poll'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		// $input = Input::all();
		$v = Validator::make($input, Poll::$rules);

		if($v->passes()) {
			$poll = $this->poll->find($id);
			$poll->update($input);

			return Redirect::route('polls.index');
		}

		return Redirect::route('polls.edit', $id)
		->withInput()
		->withErrors($v)
		->with('message', 'There were validation errors');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->poll->find($id)->delete();
		return Redirect::route('polls.index');
	}

}
