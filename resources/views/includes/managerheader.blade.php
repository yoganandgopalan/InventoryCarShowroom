<!DOCTYPE html>
<html>
<head>
    <title>Project</title>
	{!! HTML::style('bootstrap-3.3.6-dist/css/bootstrap.min.css'); !!}
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('/') }}">Manager</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('/supply') }}">View Supply's</a></li>
        <li><a href="{{ URL::to('/spares') }}">View Spare's</a></li>
        <li><a href="{{ URL::to('/cars') }}">View Car's</a></li>
        <li><a href="{{ URL::to('/invenorylist') }}">View Invenory List</a></li>
        <li><a href="{{ URL::to('/cars/create') }}">Add Car</a>
        <li><a href="{{ URL::to('/spares/create') }}">Add Spare</a>
        <li><a href="{{ URL::to('/supply/create') }}">Add Supply</a>
        <li><a href="{{ URL::to('/user/logout') }}">Logout</a>
    </ul>
</nav>
