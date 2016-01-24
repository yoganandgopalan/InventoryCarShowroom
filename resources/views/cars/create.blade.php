@include('includes.managerheader')
<h1>Add Cars</h1>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all()) !!}

{!! Form::open(array('url' => 'cars')) !!}

    <div class="form-group">
        {!! Form::label('name', 'Car:') !!}
        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('quantity', 'Qty:') !!}
       {!! Form::text('quantity', Input::old('quantity'), array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('note', 'Car Desc:', ['class' => 'control-label']) !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Create the cars!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}
@include('includes.footer')
