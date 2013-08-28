@section('title')
Edit a Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<script>
function addOption(){
	var newOption = $('.option:eq(0)').clone();
	newOption.find('input').val('').attr('placeholder', 'Option #'+($('.option').length + 1));
	var numOpts = $('.option').length;
	// don't  let the user create over 5 options
	if(numOpts < 5) {
		$('#options').append(newOption);
		if(numOpts == 4) {
			$('#addOptBtn').hide();
		}
	} 
}
// don't  let the user create over 5 options
window.onload = function() {
	var numOpts = $('.option').length;
	if(numOpts == 5) {
		$('#addOptBtn').hide();
	}
}
</script>

<div class="row">
	<div class="span4 offset3 panel">
		<h2>Edit Poll</h2>
		{{ Form::model($poll, array('method' => 'PATCH', 'route' => array('polls.update', $poll->id))) }}
		<input name="optMap" type="hidden" value="{{ $answers->optMap }}">
		<ul>
			<li>
				{{ Form::label('topic', 'Topic:') }}
				{{ Form::text('topic') }}
			</li>
			<li>
				<label>Options</label>
				<div id="options">
					@foreach ($answers as $answer)
					<div class="option">
						<input type="text" name="options[]" data-placeholder="$answer->id" value="{{ $answer->content }}">
					</div>
					@endforeach
				</div>
				<p><button class="btn"  type="button" id="addOptBtn" onclick='addOption();'><i class="icon-plus"></i> Add option</button></p>
			</li>
			<li>
				<hr>
				<a href="/"><button class="btn"  type="button" >Cancel</button></a>
				{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			</li>
		</ul>
		{{ Form::close() }}

		@if($errors->any()) 
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
		@endif
	</div>
</div>

@stop