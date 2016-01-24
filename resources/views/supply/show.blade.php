@include('includes.managerheader')
<h1>{{ $supply->spar }}</h1>
    <div class="jumbotron text-center">
        <h2>{{ $supply->spares->spar }}</h2>
        <p>
            <strong>Qty:</strong> {{ $supply->quantity }}<br>
            <strong>Note:</strong> {{ $supply->note }}
        </p>
    </div>
@include('includes.footer')
