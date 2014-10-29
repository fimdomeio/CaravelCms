@extends('admin.layout')
@section('content')
	Title

	@yield('formContent')

	{!! Form::Submit('Save', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop
