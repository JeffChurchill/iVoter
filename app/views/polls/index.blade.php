@section('title')
List of Active Polls  | iVoter
@stop

{{-- Content --}}
@section('content')
<div class="row">
	<div class="span6 offset3 panel">
		<h2>All  Current Polls</h2>

		@if ($polls->count())
		<table class="table table-striped table-bordered table-hover">
			<tbody>
				@foreach($polls as $poll)
				<tr>
					<td>
						<strong>{{ $poll->topic }}</strong>
						<div class="muted">{{ $poll->total_votes }} Votes</div>
					</td>
					<td>
						{{ link_to_route('polls.show', 'Show', array($poll->id), array('class' => 'btn btn-primary btn-mini')) }}
					</td>
					<td>
						{{ link_to_route('polls.edit', 'Edit', array($poll->id), array('class' => 'btn btn-info btn-mini')) }}
					</td>
					<td>
						{{ Form::open(array('method' => 'DELETE', 'route' => array('polls.destroy', $poll->id))) }}
						<button type="submit" href="{{ URL::route('polls.destroy', $poll->id) }}" class="btn btn-danger btn-mini" onclick="return confirm('Do you really want to delete this poll?');">Delete</button>
						{{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		@else
		There are no polls right now.
		@endif
		<a class="btn btn-block" href="/polls/create"><i class="icon-plus"></i> Add a Poll</a>
	</div>
</div>

@stop