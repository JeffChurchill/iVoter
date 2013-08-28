@extends('layouts.default')

@section('title')
Show Results of a Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<div class="row">
	<div class="span6 offset3 panel">
		<h2>{{ $poll->topic }} </h2>
		<ul class="answer-list">
			<li><hr></li>
			@foreach ($answersFinal as $answer)
			<li>
				<h4>{{ $answer['content'] }}</h4>
				<div class="progress">
					<div class="bar" style="width: <?php echo $answer['votes']/$totalVotes * 100;?>%;"></div> 
				</div>  
				<div class="vote-tally"> <?php echo $answer['votes']; ?> out of <?php echo $totalVotes; ?> total votes</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>

@stop

