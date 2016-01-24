@include('includes.managerheader')
<h1>All Car's</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Car</td>
            <td>Qty</td>
            <td>Car Desc</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($cars as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->quantity }}</td>
            <td>{{ $value->note }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /cars/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {!! Form::open(array('url' => 'cars/' . $value->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete this cars', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}
                <!-- show the nerd (uses the show method found at GET /supply/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('cars/' . $value->id) }}">Show this cars</a>

                <!-- edit this nerd (uses the edit method found at GET /cars/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('cars/' . $value->id . '/edit') }}">Edit this cars</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('includes.footer')
