@include('includes.managerheader')
	<h1>Edit {!! $spares->spar !!}</h1>
	<!-- if there are creation errors, they will show here -->
	{!! HTML::ul($errors->all()) !!}
	{!! Form::model($spares, array('route' => array('spares.update', $spares->id), 'method' => 'PUT', 'files' => true)) !!}
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
		{!! Form::select('cars[]', $cars, 
		$spares->cars->lists('id')->toArray(), 
		['class' => 'form-control', 
		'multiple' => 'multiple']) !!}
		</div>
		{!! Form::submit('Edit the spares!', array('class' => 'btn btn-primary')) !!}
	{!! Form::close() !!}
@include('includes.footer')
