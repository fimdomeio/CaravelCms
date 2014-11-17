@extends('layout')

@if(empty($title))
	{{{ die('You must provide $this->title on the Controller') }}}
@endif

@section('title'){{ $title }}@stop

@section('content')

	<h1>Welcome to Caravel v0.1</h1>

	@if(Auth::check())
		<h4>You are currently logged in as <b>{{ Auth::user()->username }}</b>.</h4>
		<br>
		<br>

		@if(Auth::viaRemember())
			<p><em>Remember me</em> auth feature is active.</p>
		@else
			<p><em>Remember me</em> auth feature is inactive.</p>
		@endif

		<pre>
          {{{ print_r($menus) }}}
        </pre>

	@else
		<h3>You are currently not logged in.</h3>
	@endif

@stop