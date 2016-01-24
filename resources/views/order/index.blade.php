@include('includes.salesmanheader')
	<h1>All Order's</h1>
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Order Id</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $key => $value)
				<tr>
				<td>{{ $value->id }}</td>
				<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('order/' . $value->id) }}">Show Order</a>
				<a cl
				</tr>
			@endforeach
		</tbody>
	</table>
@include('includes.footer')
