@include('includes.salesmanheader')
<h1> Order Id :{{ $order->id }}</h1>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Spare</td>
				<td>Quantity</td>
			</tr>
		</thead>
		<tbody>
			@foreach($order_item as $key => $value)
				<tr>
				<td>{{ $value->spar}}</td>
				<td>{{ $value->quantity}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@include('includes.footer')
