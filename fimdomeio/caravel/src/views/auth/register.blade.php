@extends('caravel::auth.layout')

@if(empty($title))
	{{{ die('You must provide $this->title on the Controller') }}}
@endif

@section('title'){{ $title }}@stop

@section('content')

	<!--<h1>Login in caravel</h1>-->

	@if($errors->has())

		<div class="alert alert-danger col-md-12" role="alert">
			<b>Could not {{str_singular($title)}}</b><br/>
			Some fields need to be reviewed.
		</div>

	@endif

	{{ Form::open() }}

	<fieldset class="col-md-4">
		<legend>Register to caravel</legend>
		{{ Form::textField('username', 'Username') }}
		{{ Form::textField('email', 'Email') }}
		{{ Form::passwordField('password', 'Password') }}
		{{ Form::passwordField('password_confirmation', 'Confirm password') }}
		{{ Form::submit('Register', array('class' => 'btn btn-success btn-lg')) }}
	</fieldset>

	{{ Form::close() }}

@stop
