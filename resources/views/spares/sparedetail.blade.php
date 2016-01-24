@include('includes.header')
<h1>{{ $spares->spar }}</h1>
<table>
	<tr><td><strong>Spare Name: </strong></td><td>{{ $spares->spar }}</td></tr>
        <tr><td><strong>Model: </strong></td><td>{{ $spares->model }}</td></tr>
        <tr>
	<td><strong>Cars:</strong></td>
	<td>
		@foreach ($spares->cars->lists('name')->toArray() as $cars)
		    {{$cars }} 
		@endforeach
	</td>
        <tr>
	<td><strong>Picture:</strong></td>
	<td>
		<div class="thumbnail"><img width="100" height="100" src="{{asset($spares->file)}}" /></div>
	</td>
	</tr>
	</tr>
        <tr><td><strong>Price: </strong></td><td>{{ $spares->price }}</td></tr>
        <tr><td><strong>Desc:</strong></td><td>{{ $spares->note }}</td></tr>
	<tr><td><strong>Qty: </strong></td><td>{{($spares->supply['attributes']['quantity']) }}</td></tr>
</table>
@include('includes.footer')
