@include('includes.managerheader')
	<h1>Add Supply</h1>
	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	{!! Form::open(array('url' => 'supply')) !!}
		<div class="form-group">
		 @if(count($spares)>0)
		   {!! Form::label('spares_id', 'Select Spar', array('class' => 'awesome')); !!}
		   {!!Form::select('spares_id', $spares) !!}
		 @endif 
		</div>

		<div class="form-group">
		{!! Form::label('quantity', 'Qty:') !!}
		{!! Form::text('quantity', Input::old('quantity'), array('class' => 'form-control')) !!}
		</div>

		<div class="form-group">
		{!! Form::label('note', 'Note:', ['class' => 'control-label']) !!}
		{!! Form::textarea('note', null, ['class' => 'form-control']) !!}
		</div>
		{!! Form::submit('Create the Supply!', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
@include('includes.footer')
