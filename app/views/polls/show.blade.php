@section('title')
Show a Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<div class="row">
	<div class="span6 offset3 panel">
	<h2>{{ $poll->topic }}</h2>
	<ul class="list-unstyled">
		@foreach ($answers as $answer)
	    <li>{{ $answer->content }}</li>
	    @endforeach
	</ul>

</div>
</div>

@stop