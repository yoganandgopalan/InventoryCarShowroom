<!DOCTYPE html>
<html>
<head>
    <title>Project</title>
	{!! HTML::style('bootstrap-3.3.6-dist/css/bootstrap.min.css'); !!}
	{!! HTML::script('custom_js/jquery.min.js'); !!}
	{!! HTML::script('custom_js/order.js'); !!}
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('/') }}">Salesman</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('/order') }}">View Order's</a></li>
        <li><a href="{{ URL::to('/invenorylist') }}">View Invenory List</a></li>
        <li><a href="{{ URL::to('/order/create') }}">Add Order</a>
        <li><a href="{{ URL::to('/user/logout') }}">Logout</a>
    </ul>
</nav>
