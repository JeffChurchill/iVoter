@section('title')
Edit a Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<div class="hero-unit">
	<h2>Edit Poll</h2>
	{{ Form::model($poll, array('method' => 'PATCH', 'route' => array('polls.update', $poll->id))) }}
	<ul>
		<li>
			{{ Form::label('topic', 'Topic:') }}
			{{ Form::text('topic') }}
		</li>
		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
	{{ Form::close() }}

@if($errors->any()) 
	<ul>
	    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif
</div>

@stop