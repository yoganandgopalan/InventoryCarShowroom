@include('includes.header')
	<h1>Inventory List</h1>
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Spare Name</td>
				<td>Model</td>
				<td>Pic</td>
				<td>Qty</td>
				<td>Cars</td>
				<td>View</td>
			</tr>
		</thead>
		<tbody>
			@foreach($spares as $key => $value)
				<tr>
				<td>{{ $value->spar }}</td>
				<td>{{ $value->model }}</td>
				<td>
				<div class="thumbnail"><img width="20" height="20" src="{{asset($value->file)}}" /></div>
				</td>
				<td>{{($value->supply['attributes']['quantity']) }}</td>
				<td>
				@foreach ($value->cars->lists('name','id')->toArray() as $key => $cars)
				<a class="btn btn-xs btn-success" href="{{ URL::to('cars/' . $key) }}">{{$cars }}</a>
				@endforeach
				</td>
				<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('sparedetail/' . $value->id) }}">View</a>
				</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@include('includes.footer')
