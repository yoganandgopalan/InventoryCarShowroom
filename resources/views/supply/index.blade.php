@include('includes.managerheader')
	<h1>All Supply's</h1>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Spar</td>
				<td>Qty</td>
				<td>Note</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			@foreach($supply as $key => $value)
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{$value->spares->spar }}</td>
				<td>{{ $value->quantity }}</td>
				<td>{{ $value->note }}</td>
				<td>
				{!! Form::open(array('url' => 'supply/' . $value->id, 'class' => 'pull-right')) !!}
				{!! Form::hidden('_method', 'DELETE') !!}
				{!! Form::submit('Delete Supply', array('class' => 'btn btn-warning')) !!}
				{!! Form::close() !!}
				<a class="btn btn-small btn-success" href="{{ URL::to('supply/' . $value->id) }}">Show Supply</a>
				<a class="btn btn-small btn-info" href="{{ URL::to('supply/' . $value->id . '/edit') }}">Edit Supply</a>

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@include('includes.footer')
