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
	 * Display a listing of the polls.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$polls = $this->poll->all();
		$this->layout->content = View::make('polls.index', compact('polls'));
	}

	/**
	 * Show the form for creating a new poll.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('polls.create');
	}

	/**
	 * Store a newly created poll in storage.
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
				if(!empty($option)) {
					$optPayload = array(
						'content' => $option,
						'polls_id' => $poll->id
						);
					$this->answer->create($optPayload);
				}
			}
			return Redirect::route('polls.index');
		}
		return Redirect::route('polls.create')
		->withInput()
		->withErrors($v)
		->with('message', 'There were validation errors');
	}

	/**
	 * Display the specified poll.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the poll with id of $id and pass it to the view
		$poll = $this->poll->findOrFail($id);
		$answers = Poll::find($id)->answers;
		$clentIp = $_SERVER['REMOTE_ADDR'];
		$hasVoted = Vote::hasVoted($clentIp, $id);
		if(!empty($hasVoted->id)) {
			// let's show results
			return View::make('polls.results',  compact('poll', 'answers'));
		}
		$this->layout->content = View::make('polls.show', compact('poll', 'answers'));
	}

	/**
	 * Show the form for editing the specified poll.
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
		$answers = Poll::find($id)->answers;
		$optMap = "";
		foreach ($answers as $answer) {
			$optMap .= $answer->id . "-";
		}
		$answers->optMap = substr($optMap, 0, -1); 
		$this->layout->content = View::make('polls.edit', compact('poll', 'answers'));
	}

	/**
	 * Update the specified poll in storage.
	 *  TODO: this action is getting large. Move some stuff to the model
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$pollArray = array('topic' => $input['topic']);
		$optionsArray = $input['options'];
		$optMap = explode('-', $input['optMap']);
		$v = Validator::make($input, Poll::$rules);
		if($v->passes()) {
			$poll = $this->poll->find($id);
			$poll->update($pollArray);
			// separate any old options from new ones 
			// so we can easily update or create
			$oldOpts = array();
			$newOpts = array();
			$countOld = count($optMap);
			for($i = 0; $i < $countOld; $i++) {
				$optPayload = array(
					'content' => $optionsArray[$i],
					'polls_id' => $poll->id
					);
				$answer = $this->answer->find($optMap[$i]);
				$answer->update($optPayload);
			}
			// now finish out by creating the new options
			for($i; $i < count($optionsArray); $i++) {
				$optPayload = array(
					'content' => $optionsArray[$i],
					'polls_id' => $poll->id
					);
				$this->answer->create($optPayload);
			}
			return Redirect::route('polls.index');
		}
		return Redirect::route('polls.edit', $id)
		->withInput()
		->withErrors($v)
		->with('message', 'There were validation errors');
	}

	/**
	 * Remove the specified poll from storage.
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
