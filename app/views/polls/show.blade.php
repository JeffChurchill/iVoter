<?php // TODO: Find a rock solid way to get the client;s IP  ?>

@section('title')
Show a Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<div class="row">
	<div class="span6 offset3 panel">
		<h2>{{ $poll->topic }}</h2>

		{{ Form::open(array('route' => 'votes.store')) }}
		<input name="uip" type="hidden" value="<?php echo  $_SERVER['REMOTE_ADDR']; ?>">
		<ul class="answer-list">
			@foreach ($answers as $answer)
			<li>{{ $answer->content }}</li>
			@endforeach
		</ul>

		{{ Form::close() }}
	</div>
</div>

@if($errors->any()) 
<ul>
	{{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif
@stop
