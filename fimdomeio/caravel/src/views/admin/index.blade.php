
@extends('caravel::admin.layout')


@section('content')
	<a href="{{strtolower($title)}}/create" class="btn btn-primary">add {{str_singular($title)}}</a>
	@include('caravel::admin.elements.list')

@stop
