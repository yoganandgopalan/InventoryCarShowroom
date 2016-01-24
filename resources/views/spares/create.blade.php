@include('includes.managerheader')
	<h1>Add spare</h1>
	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	{!! Form::open(array('url' => 'spares', 'method' => 'post', 'files' => true )) !!}
		<div class="form-group">
		{!! Form::label('spar', 'Spare Name:') !!}
		{!! Form::text('spar', Input::old('spar'), array('class' => 'form-control')) !!}
		</div>
		<div class="form-group">
		{!! Form::label('model', 'Model:') !!}
		{!! Form::text('model', Input::old('model'), array('class' => 'form-control')) !!}
		</div>
		<div class="form-group">
		{!! Form::label('category', 'Category:') !!}
		{!! Form::text('category', Input::old('category'), array('class' => 'form-control')) !!}
		</div>
		<div class="form-group">
		{!! Form::label('price', 'Price:') !!}
		{!! Form::text('price', Input::old('price'), array('class' => 'form-control')) !!}
		</div>
		<div class="form-group">
		{!! Form::label('note', 'Desc:', ['class' => 'control-label']) !!}
		{!! Form::textarea('note', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('file', 'Picture:', ['class' => 'control-label']) !!}
		{!! Form::file('file', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('Cars:') !!}<br />
		{!! Form::select('cars[]', 
		$cars, 
		null, 
		['class' => 'form-control', 
		'multiple' => 'multiple']) !!}
		</div>
	{!! Form::submit('Create the spares!', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
@include('includes.footer')
