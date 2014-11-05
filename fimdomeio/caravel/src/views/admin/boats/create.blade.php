@extends('caravel::admin.layout')


@section('content')
<h1>Add {{str_singular($title)}}</h1>
@if($errors->has())
<div class="alert alert-danger col-md-12" role="alert">
<b>Could not save {{str_singular($title)}}</b><br/>
Some fields need to be reviewed
</div>

@endif
{{ Form::open(array('action' => '\Fimdomeio\Caravel\BoatsController@store')) }}


<fieldset class="col-md-4">
	<legend>Basic Info</legend>
	{{Form::textField('name', 'Name')}}
	{{Form::textField('build_date', 'Build Date')}}
	{{Form::textareaField('description', 'description')}}

	{{Form::radioButtonsField('published', [
		['value' => 1, 'label' => 'Published', 'checked' => true],
		['value' => 0, 'label' => 'Draft']
	])}}


<div class="col-md-12 text-center">
	{{Form::submit('Save', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
@stop
