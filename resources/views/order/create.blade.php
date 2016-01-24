@include('includes.salesmanheader')
	<h1>Add Order</h1>
	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	{!! Form::open(array('url' => 'order', 'method' => 'post', 'files' => true )) !!}

<div class="input_fields_wrap">
    <button class="add_field_button">Add More Fields</button>
	<div class="form-group">
		@if(count($spares)>0)
			{!! Form::label('spares_id', 'Select Spar', array('class' => 'awesome')); !!}
			{!!Form::select('spares_id[]', $spares) !!}
		@endif 
		{!! Form::label('quantity[]', 'Qty:') !!}
		{!! Form::text('quantity[]', Input::old('quantity[]'), array('class' => '')) !!}
	</div>
	<script>
	var spares = {!! $spares !!}
	</script>
</div>
	{!! Form::submit('Create the spares!', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
@include('includes.footer')
