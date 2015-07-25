@extends('app')

@section('content')

	<div class="intro">
		<h1>Hello.</h1>
		<div class="links">
			<a href="{{ url('auth/login') }}">Log in</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="{{ url('auth/register') }}">Register</a>
		</div>
		<img src="/img/sweet-potato.jpeg" alt="Sweet Potato">
	</div>

@endsection