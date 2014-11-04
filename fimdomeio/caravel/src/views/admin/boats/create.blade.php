@extends('caravel::admin.layout')


@section('content')
<h1>Add {{$title}}</h1>
{{ Form::open(array('action' => '\Fimdomeio\Caravel\BoatsController@store')) }}


<fieldset class="col-md-4">
	<legend>Basic Info</legend>
	{{Form::textField('name', 'Name')}}
	{{Form::textField('build_date', 'Date')}}
	{{Form::textareaField('description', 'description')}}
	{{Form::textField('published', 'Published')}}


</fieldset>
<div class="col-md-12 text-center">
	{{Form::submit('Save', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
@stop
