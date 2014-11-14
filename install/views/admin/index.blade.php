@extends('admin.layout')

@if(empty($title))
	{{{die('You must provide $this->title on the Controller')}}}
@endif

@section('content')
	<a href="{{strtolower($title)}}/create" class="btn btn-primary">add {{str_singular($title)}}</a>
	@include('caravel::admin.elements.list')

@stop
