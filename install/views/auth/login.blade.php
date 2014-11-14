@extends('auth.layout')

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
		<legend>Log in to caravel</legend>
		{{ Form::textField('email', 'Email') }}
		{{ Form::passwordField('password', 'Password') }}
		{{ Form::checkboxField('remember_me', 'Remember me') }}
		{{ Form::submit('Log in', array('id' => 'loginSubmitButton', 'class' => 'btn btn-success btn-lg')) }}
	</fieldset>

	{{ Form::close() }}

@stop
