@include('includes.managerheader')
<h1>{{ $spares->spar }}</h1>
    <div class="jumbotron text-center">
        <h2>{{ $spares->spar }}</h2>
	<h3><div class="thumbnail"><img width="100" height="100" src="{{asset($spares->file)}}" /></div></h2>
        <p>
            <strong>price:</strong> {{ $spares->price }}<br>
            <strong>Desc:</strong> {{ $spares->note }}<br>
            <strong>Cars:</strong>
		@foreach ($spares->cars->lists('name')->toArray() as $cars)
		    {{$cars }} 
		@endforeach
	   </strong>
        </p>
    </div>
@include('includes.footer')
