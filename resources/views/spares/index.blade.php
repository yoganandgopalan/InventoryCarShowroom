@include('includes.managerheader')
	<h1>All Spare's</h1>
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Spare Name</td>
				<td>Model</td>
				<td>Category</td>
				<td>Pic</td>
				<td>price</td>
				<td>Cars</td>
				<td>Desc</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			@foreach($spares as $key => $value)
				<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->spar }}</td>
				<td>{{ $value->model }}</td>
				<td>{{ $value->category }}</td>
				<td>
				<div class="thumbnail"><img width="20" height="20" src="{{asset($value->file)}}" /></div>
				</td>
				<td>{{ $value->price }}</td>
				<td>
				@foreach ($value->cars->lists('name')->toArray() as $cars)
				{{$cars }} 
				@endforeach
				</td>
				<td>{{ $value->note }}</td>
				<td>
					{!! Form::open(array('url' => 'spares/' . $value->id, 'class' => 'pull-right')) !!}
					{!! Form::hidden('_method', 'DELETE') !!}
					{!! Form::submit('Delete spare', array('class' => 'btn btn-warning')) !!}
					{!! Form::close() !!}
				<a class="btn btn-small btn-success" href="{{ URL::to('spares/' . $value->id) }}">Show Spare</a>
				<a class="btn btn-small btn-info" href="{{ URL::to('spares/' . $value->id . '/edit') }}">Edit Spare</a>
				</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@include('includes.footer')
