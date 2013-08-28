@extends('layouts.default')

@section('title')
Show Results of a Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<div class="row">
	<div class="span6 offset3 panel">
		<h2>{{ $poll->topic }}</h2>
		<ul class="answer-list">
			<li><hr></li>
			@foreach ($answers as $answer)
			<li>{{ $answer->content }}</li>
			@endforeach
		</ul>
	</div>
</div>

@stop
