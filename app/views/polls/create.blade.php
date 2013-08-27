@section('title')
Create New Poll  | iVoter
@stop

{{-- Content --}}
@section('content')

<script>
function addText(){
		var newOption = $('.option:eq(0)').clone();
		newOption.find('input').val('').attr('placeholder', 'Option #'+($('.option').length + 1));
		$('#options').append(newOption);
}
</script>
<div class="hero-unit">
	<h2>Create A New Poll</h2>
	{{ Form::open(array('route' => 'polls.store')) }}
	<ul>
		<li>
			{{ Form::label('topic', 'Topic:') }}
			{{ Form::text('topic') }}
		</li>
		<li>
			<label>Options</label>
			<div id="options">
				<div class="option">
					<input type="text" name="options[]" placeholder="Option #1">
				</div>
				<div class="option">
					<input type="text" name="options[]" placeholder="Option #2">
				</div>
				<div class="option">
					<input type="text" name="options[]" placeholder="Option #3">
				</div>
			</div>
			<p><button class="btn"  type="button"   onclick='addText();'><i class="icon-plus"></i> Add option</button></p>
		</li>
		<li>
			<button class="btn btn-primary"><i class="icon-ok icon-white"></i> Save poll</button>
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