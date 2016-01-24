@include('includes.managerheader')
<h1>Showing {{ $cars->cars }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $cars->name }}</h2>
        <p>
            <strong>Qty:</strong> {{ $cars->quantity }}<br>
            <strong>Desc:</strong> {{ $cars->note }}
        </p>
    </div>
@include('includes.footer')
