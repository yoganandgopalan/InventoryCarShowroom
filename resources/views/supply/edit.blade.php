@include('includes.managerheader')
<h1>Edit {!! $supply->spar !!}</h1>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all()) !!}

{!! Form::model($supply, array('route' => array('supply.update', $supply->id), 'method' => 'PUT')) !!}

    <div class="form-group">
	@if(count($spares)>0)
	{!! Form::label('spares_id', 'Select Spar', array('class' => 'awesome')); !!}
	{!! Form::select('spares_id[]', $spares, 
	$spares_selected, 
	['class' => 'form-control']) !!}
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

    {!! Form::submit('Edit Supply!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}
@include('includes.footer')
